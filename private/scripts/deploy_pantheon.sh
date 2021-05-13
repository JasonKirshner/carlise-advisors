#!/bin/bash

## This file is used to automatically deploy to pantheon. 
## This file needs to be executed from the root of the project to be successful.
##
## The following variables need to be present for this script to complete. 
## These can be set in the GitLab repository Settings > CI/CD
##
## THEME_NAME - name of theme to be used
## TERMINUS_TOKEN - machine token for the CI runner. Set in gitlab group vars
## SLACK_TOKEN - access token for the custom slack app to send notifications
##
## The following variabes are determined automatically
## PANTHEON_ID - the ID string of the Pantheon Site - read from the .lando.yml file, but can be overridden
## BRANCH_NAME - the branch to be used 
## ENV - which staging environent (multidev) we should deploy to. This is defined based on ENV
## SLACK_CHANNEL - this should probably be set as a project variable, but if it isn't we'll fall back and attempt to use $PANTHEON_ID

SCRIPT_PATH="`dirname \"$0\"`"
printf "\n\n";

printf "Verifying git user details...\n";
git config --global user.email
git config --global user.name

printf "Logging into terminus...\n";
terminus auth:login --machine-token=$TERMINUS_TOKEN;

if [ -z ${PANTHEON_ID+x} ]; then
    printf "Hmm... doesn't look like our pantheon site is defined. Attempting to retrieve it from the lando config file...\n";
    if [ -f ".lando.yml" ]; then 
        printf "Lando config file found. Attempting to determine pantheon site name...\n";
        source "$SCRIPT_PATH/parse_yaml.sh";
        eval $(parse_yaml .lando.yml "lando_");

        printf "Site name found to be <$lando_config_site>. Setting script variable accordingly...\n"; 
        PANTHEON_ID="$lando_config_site";
    else
        printf "No lando config file found. Please supply a Pantheon site name to continue using this script...\n";
        exit 1;
    fi
fi

if [ -z ${CI_COMMIT_REF_NAME+x} ]; then
    printf "Hmm... doesn't look like the branch name is defined yet.. What branch are we using?\n";
    read BRANCH_NAME;
else
    printf "Setting branch name to be <$CI_COMMIT_REF_NAME>...\n";
    BRANCH_NAME=$CI_COMMIT_REF_NAME;
fi

if [ -z ${THEME_NAME+x} ]; then
    printf "Hmm... doesn't look like the theme name is defined yet.. What's the name of the theme we are we using?\n";
    read THEME_NAME;
fi

## Pantheon remote setup ##
printf "Checking to make sure pantheon remote is correct...\n";
PANTHEON_REMOTE=$(terminus connection:info $PANTHEON_ID.dev --field=git_url);
PANTHEON_REMOTE_EXISTS="$?";

if [ $PANTHEON_REMOTE_EXISTS -eq 0 ]; then
    printf "Found the git_url for the Pantheon remote repository. Making sure it's added now...\n";
    REMOTE=$(git remote | grep pantheon);
    if [ $? -eq 0 ]; then 
        printf "Looks like a remote named 'pantheon' already exists. Making sure it's the right one...\n";
        git remote -vv | grep $PANTHEON_REMOTE;
        if [ $? != 0 ]; then 
            printf "Wellp, that doesn't look like the right remote URL - correcting the pantheon remote url now...\n";
            git remote set-url pantheon $PANTHEON_REMOTE;
            if [ $? -eq 0 ]; then
                printf "Successfully updated the pantheon remote url. Onward and upward!\n\n";
            else
                printf "Well, this just isn't going to work.. Looks like we had some trouble updating the remote url. Goodbye\n";
                exit 1;
            fi
        else
            printf "Pantheon remote url checks out. Moving on...\n\n";
        fi
    else 
        printf "No remote named pantheon detected. Adding one now...\n";
        git remote add pantheon $PANTHEON_REMOTE;
        if [ $? -eq 0 ]; then
            printf "Looks like pantheon remote was sucessfully added. Onward and upward!\n\n";
        else
            printf "Hmm.. looks like we had some trouble adding the pantheon remote, so we can't move forward. Contact your project's lead developer for help. Goodbye...\n\n";
            exit 1;
        fi
    fi
else
    printf "Couldn't find a git_url for the Pantheon remote on the $PANTHEON_ID Pantheon site. Make sure the pantheon environment <$PANTHEON_ID>.<dev> exists and try again...\n\n";
    exit 1;
fi
## END Pantheon Remote Setup ##

## Auto Deploy ##
BRANCH_TYPE=$(cut -d "/" -f1 <<< $BRANCH_NAME );
BRANCH_LABEL=$(cut -d "/" -f2 <<< $BRANCH_NAME | cut -c -11 | tr '[:upper:]' '[:lower:]');

printf "Branch type is \"$BRANCH_TYPE\"\n";

if [ $BRANCH_TYPE == 'hotfix' ]; then
    printf "Looks like this is a hotfix branch - we'll use the <$BRANCH_TYPE> environment to stage the changes\n";
    ENV=$BRANCH_TYPE;
elif [ $BRANCH_TYPE == 'develop' ]; then
    printf "Looks like this is the develop branch - we'll use the <internal> environment to stage the changes\n";
    ENV='internal';
else 
    printf "Setting <$BRANCH_LABEL> as the environment name to use...\n";
    ENV=$BRANCH_LABEL;
fi

if [ $BRANCH_LABEL == 'master' ]; then
    printf "Skipping the multidev workflow since we're on the master branch..."
else
    printf "Checking to make sure that the <$ENV> multidev exists on Pantheon...\n";
    ENV_CHECK=$(terminus multidev:list --field=Name $PANTHEON_ID | grep $ENV);
    ENV_EXISTS="$?";

    # Check if pantheon environment exists
    if [ $ENV_EXISTS -eq 0 ]; then
        printf "Pantheon environment <$ENV> exists on <$PANTHEON_ID>, we'll use it going forward.\n";
    else
        printf "No pantheon environment named \"$ENV\" found on <$PANTHEON_ID>, creating one now...\n";
        printf "First, let's determine which database we should set up the multidev environment with...\n";

        LIVE_ENV_TAG=$(git ls-remote --tags pantheon | grep "pantheon_live_");
        LIVE_ENV_EXISTS="$?";

        TEST_ENV_TAG=$(git ls-remote --tags pantheon | grep "pantheon_test_");
        TEST_ENV_EXISTS="$?";

        if [ $LIVE_ENV_EXISTS -eq 0 ]; then
            DATA_ENV="live";
        elif [ $TEST_ENV_EXISTS -eq 0 ]; then
            DATA_ENV="test";
        else
            DATA_ENV="dev";
        fi

        printf "Found the most recent data environment to be <$PANTHEON_ID>.<$DATA_ENV>. Setting up a new multidev environment for <$ENV> using the data and files in <$PANTHEON_ID>.<$DATA_ENV>...\n";
        terminus multidev:create $PANTHEON_ID.$DATA_ENV $ENV;
        if [ $? != 0 ]; then 
            printf "Something went wrong. Maybe try creating the <$PANTHEON_ID>.<$DATA_ENV> manually and give this another shot...\n";
            exit 1;
        fi
        printf "Hype. Pantheon environment <$PANTHEON_ID>.<$ENV> has been created!\n";
    fi
fi


printf "Force pushing current code to the <$ENV> branch on <$PANTHEON_ID>...\n";
git push -f pantheon HEAD:$ENV;
if [ $? != 0 ]; then
    printf "Like zoinks, Scoob. Looks like we had some trouble getting the code to the <$PANTHEON_ID>.<$ENV> Pantheon multidev. Let's get outta here..\n";
    exit 1;
fi
printf "Done\n";

printf "Checking out the <$THEME_NAME> theme...\n";
cd "./wp-content/themes/$THEME_NAME";
if [ $? != 0 ]; then
    printf "These are not the droids you're looking for... Couldn't find the theme here. Check your theme name and try again..\n";
    exit 1;
fi

printf "Installing theme dependencies...\n";
if [ -f "./package-lock.json" ]; then
    printf "package-lock.json file found. Removing to avoid package manager conflicts...\n\n";
    rm ./package-lock.json;
fi
if [ -f "./yarn.lock" ]; then
    printf "yarn.lock file found, nice! We'll install securely...\n\n";
    yarn install --pure-lockfile --cache-folder .yarn;
else
    printf "No yarn.lock file found..  We'll install without it, but you should consider committing it!\n";
    yarn;
fi
if [ $? != 0 ]; then
    printf "Ermm... something went wrong with the installation.. Please check the theme's packages and try again...\n";
    exit 1;
fi

printf "\n\nInstallation complete, compiling project assets now...\n";
yarn build;
if [ $? != 0 ]; then
    printf "Ermm... something went wrong with the build.. Please check the theme's build process and try again...\n";
    exit 1;
fi

CHANGES=$(git status --porcelain);

if [ -z "$CHANGES" ]; then
    printf "Doesn't look like we have any changes to commit...\n";
else
    printf "Changes detected! Committing them now..\n";
    git add --all && git commit -am "Process styles and scripts";
    if [ $? != 0 ]; then
        printf "Hmm.. something went wrong while committing changes. Please check the theme's build process and try again...\n";
        exit 1;
    fi
    printf "Pushing changes to pantheon...";
    git push pantheon HEAD:$ENV;
    if [ $? != 0 ]; then
        printf "Like zoinks, Scoob. Looks like we had some trouble getting the code to the <$PANTHEON_ID>.<$ENV> Pantheon multidev. Let's get outta here..\n";
        exit 1;
    fi
fi

printf "Deployment complete! Attempting to clear the environment cache just to be safe...\n";
if [ $ENV == 'master' ]; then
    terminus env:clear-cache $PANTHEON_ID.dev
else
    terminus env:clear-cache $PANTHEON_ID.$ENV
fi

## END Auto Deploy ##

## Send Slack Channel Message ##
## @see https://api.slack.com/methods/chat.postMessage

# if [ -z ${SLACK_TOKEN+x} ]; then
#     printf "Couldn't locate an API Token for a slack channel. You can store the access token as a variable enable slack notifications for your team.\n";
# else
#     STAGING_LINK="https://$ENV-$PANTHEON_ID.pantheonsite.io/";
    
#     if [ -z ${SLACK_CHANNEL+x} ]; then
#         printf "No slack channel set - attempting to notify the team using <#$PANTHEON_ID> as the channel name...\n";
#         SLACK_CHANNEL=$PANTHEON_ID;
#     fi

#     printf "Looks like we have a slack account API token available. Attempting to notify the <$SLACK_CHANNEL> channel in the Ruckus workspace...\n";
#     printf "Staging link expected to be <$STAGING_LINK>\n";

#     curl --request POST \
#     --url https://slack.com/api/chat.postMessage \
#     --header "Authorization: Bearer $SLACK_TOKEN" \
#     --header "Content-Type: application/json" \
#     --data "{\"channel\": \"#$SLACK_CHANNEL\",\"text\": \"<!here> A new code version has just been deployed! You might want to touch base with the project developer to see if any content entry is needed. Here's a link to review:\n$STAGING_LINK\", \"as_user\": false, \"username\": \"Ruckus CI\", \"icon_url\":\"https://www.ruckusmarketing.com/wp-content/uploads/2019/09/ruckus-logo-150x150.jpg\"}"\;
# fi

# ## End Send Slack Channel Message ##

printf "\n\n";
exit 0;

