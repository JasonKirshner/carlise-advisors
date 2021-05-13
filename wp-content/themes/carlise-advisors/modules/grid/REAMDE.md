# Summary

This module is used for handling grid layouts of any orientation, with the ability
to append a header or footer to the module.

## Example config

```php
  $data = [
    ['title' => 'This is a title', 'copy' => 'This is copy']
    ['title' => 'This is a title', 'copy' => 'This is copy'],
    ['title' => 'This is a title', 'copy' => 'This is copy'],
  ];

  the_module('grid', array(
    'tagline' => 'Grid tagline',
    'title' => 'Grid title',
    'copy' => 'Grid copy',
    'title_copy_class' => 'title-copy--row',
    'grid_items' => array_map(function ($card) {
      return get_module('person-card', array(
        'title' => $card['title'],
        'copy' => $card['copy'],
        'class' => 'small-cta--vertical'
      ));
    }, $data),
    'gutter' => 'lg',
    'bottom_description' => '<p>This is content from a wysiwyg</p>',
    'cta' => array('url' => 'google.com', 'title' => 'google')
  ));
```

## Parameters

This modules accepts the follwing arguments:

- `$tagline` (type = string): Will be passed to the title-copy module included above the grid items

- `$title` (type = string): Will be passed to the title-copy module included above the grid items

- `$copy` (type = string): Will be passed to the title-copy module included above the grid items

- `$title_copy_class` (type = string): Will be passed to the title-copy module included above the grid items for modification. Ex: **title-copy--row**

- `$grid_items` (type = array): The items that will be used in the grid, usually card modules

- `$gutter` (type = string): The spacing between grid items. Available values: lg, md, sm

- `$bottom_description` (type = wysiwyg): wysiwyg content that will be appended to the bottom of the grid

- `$cta` (type = array): A link array that will append a cta below the bottom description
