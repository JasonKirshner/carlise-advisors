#!/bin/bash

function commit_changes () {
    CHANGES=$(git status --porcelain);
    COMMIT_MESSAGE="$1"

    if [ -z "$CHANGES" ]; then
        printf "Doesn't look like we have any changes to commit...\n";
    else
        printf "Changes detected! Committing them now..\n";
        git add --all && git commit -am "$COMMIT_MESSAGE";
        if [ $? != 0 ]; then
            printf "Hmm.. something went wrong while committing changes. Please check the theme's build process and try again...\n";
            exit 1;
        fi
    fi
}

echo "Updating WordPress core to most recent version...";
lando wp core update;
commit_changes "Update WordPress core";

echo "Fetching plugins that need to be updated...";
PLUGINS_TO_UPDATE=$(lando wp plugin list --update=available --fields=name --format=csv | tail -n +2);

for NAME in $PLUGINS_TO_UPDATE ; do 
    PLUGIN_NAME=$(echo ${NAME} | tr -d '\040\011\012\015');
    echo "Attempting to update plugin: <${PLUGIN_NAME}>";
    lando wp plugin update $PLUGIN_NAME

    commit_changes "Update plugin - $PLUGIN_NAME";
done
