# Button Module

## Usage
This module should be used for any button links within the site. It can be rendered with an `<a>` tag or a `<button>` tag. Passing any value in the `$use_button_tag` argument will render the button with a `<button>` tag. The styling for this module should be setup from a design styleguide for each project.

### Code
```php
the_module('button', array(
    'use_button_tag' => true, // default false - optional
    'class' => 'extra-class', // optional
    'link' => 'https://example.com', // required if $tag == 'a'
    'value' => 'Click Me', // required
    'data' => 'data-attr="example"' // optional
));
```

### Will Render
```html
<button class="button button--button extra-class" data-attr="example">Click Me</button>
```

## Required Params
This module requires a `$value` parameter to be passed. If `$tag == 'a'`, a `$link` parameter is required.
