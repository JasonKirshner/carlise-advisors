const mediaGridObserver = new MutationObserver(function (mutations) {
  for (let i = 0; i < mutations.length; i++) {
    for (let j = 0; j < mutations[i].addedNodes.length; j++) {
      // eslint-disable-next-line no-undef
      const element = jQuery(mutations[i].addedNodes[j])
      if (element.attr('class')) {
        if (element.attr('class').indexOf('attachment') !== -1) {
          const attachmentPreview = element.children('.attachment-preview')
          if (attachmentPreview.length !== 0) {
            if (attachmentPreview.attr('class').indexOf('subtype-svg+xml') !== -1 ||
            attachmentPreview.attr('class').indexOf('subtype-svg') !== -1) {
              const handler = (function (element) {
                // eslint-disable-next-line no-undef
                jQuery.ajax({
                  // eslint-disable-next-line no-undef
                  url: script_vars.AJAXurl,
                  type: 'POST',
                  dataType: 'html',
                  data: {
                    action: 'svg_get_attachment_url',
                    attachmentID: element.attr('data-id')
                  },
                  success: function (data) {
                    if (data) {
                      element.find('img').attr('src', data)
                      element.find('.filename').text('SVG Image')
                    }
                  }
                })
              }(element))
            }
          }
        }
      }
    }
  }
})

// Observer to adjust the media attachment modal window
const attachmentPreviewObserver = new MutationObserver(function (mutations) {
  // look through all mutations that just occured
  for (let i = 0; i < mutations.length; i++) {
    // look through all added nodes of this mutation
    for (let j = 0; j < mutations[i].addedNodes.length; j++) {
      // eslint-disable-next-line no-undef
      const element = jQuery(mutations[i].addedNodes[j])

      // check if this is the attachment details section or if it contains the section
      // need this conditional as we need to trigger on initial modal open (creation) + next and previous navigation through media items
      let onAttachmentPage = false
      if ((element.hasClass('attachment-details')) || element.find('.attachment-details').length !== 0) {
        onAttachmentPage = true
      }

      if (onAttachmentPage === true) {
        // find the URL value and update the details image
        const urlLabel = element.find('span[data-setting="url"]')

        if (urlLabel.length !== 0) {
          const value = urlLabel.find('input').val()
          element.find('.details-image').attr('src', value)
        }
      }
    }
  }
})

// eslint-disable-next-line no-undef
jQuery(document).ready(function () {
  mediaGridObserver.observe(document.body, {
    childList: true,
    subtree: true
  })

  attachmentPreviewObserver.observe(document.body, {
    childList: true,
    subtree: true
  })
})
