jQuery(document).ready(function ($){
    //var acs_action = '/Applications/AMPPS/www/mikaeleng/wp-admin/admin-ajax.php';
   

      var acs_action = 'myprefix_autocompletesearch';
      var options = {
        serviceUrl: MyAcSearch.url+'?callback=?&action='+acs_action, //MyAcSearch.url+'?callback=?&action='+acs_action, '/mikaeleng/wp-content/themes/rwd/library/models/AjaxModel.php',//
        minChars: 2,
        appendTo: '#selection',
        type: "GET",
        contentType: "application/*",
        dataType: "text",
        converters: {
          "text html": jQuery.parseJSON,
        },
        onSearchComplete: function (query, suggestions){
          
          printer(query + " RESULT " + suggestions);
        },
        noSuggestionNotice: 'Sorry, no matching results',
        onSearchError: function(query, jqXHR, textStatus, errorThrown){
         
          printer(errorThrown);
        },
        transformResult: function(response) {
          printer(response.RESULTS);
                  
                 /* return {
                      suggestions: $.map(response.RESULTS, function(dataItem) {
                          return { value: dataItem.label, data: dataItem.link };
                  })
              };*/
          }
      };
      $('#tag-term').devbridgeAutocomplete(options);
      
});