$('#summernote').summernote({
  lang    : 'tr-TR',
  tabsize : 2,
  height  : 500,
  toolbar : [
    ['style', ['style']],
    ['font',['bold','italic','underline','clear']],
    // ['fontname',['fontname']],
    ['height',['height']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'video', 'hr']],
    ['view', ['fullscreen', 'codeview']],
    // ['help',['help']]
  ],
  cleaner:{
    action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
    newline: '<br>', // Summernote's default is to use '<p><br></p>'
    notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
    keepHtml: true, // Remove all Html formats
    keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], // If keepHtml is true, remove all tags except these
    keepClasses: false, // Remove Classes
    badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
    badAttributes: ['style', 'start'], // Remove attributes from remaining tags
    limitChars: false, // 0/false|# 0/false disables option
    limitDisplay: 'both', // text|html|both
    limitStop: false, // true/false
    limitDisplay: 'nome' // none|text|html|both
  }
});
