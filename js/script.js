var app = angular.module("fusionStyle", ['angularUtils.directives.dirPagination']);

app.controller("myCtrl",function($scope, $http){
    $scope.items = []; //array for fetch items
    $scope.sortvalue = "price"; //variable to sort data by price and rating
    $scope.sortReverse = 0;   // variable for sorting order (ascending or descending)
    $scope.apiHits = 0;
    $scope.priceRange = document.getElementById("priceRange").max;

    activate();

    function activate()
    {

        fetchData();
    }  
       

    //function for fetching data via ajax call to web api
    function fetchData()
    {
        URL="https://hackerearth.0x10.info/api/fashion?type=json&query=list_products";
        $.ajax({url: URL, success: function(result){
            $scope.items = $scope.items.concat(result["products"]);
            $scope.apiHits = result["quote_available"];
            }               
         }).done(function(){
            $scope.$apply(function() {
                console.log($scope.items);
                console.log(document.getElementById("priceRange").max)
            });
            
         });
    }

    //fuction for order filter
    $scope.orderByFunction = function(item){
        if($scope.sortvalue=='rating'){
            return parseFloat(item.rating);
        }
        else{
            return parseFloat(item.price);
        }
        
    }

});

//custom filter for price range and search text
app.filter('mySearchFilter', function(){
  return function(data, scope, searchTerm) {
      // If no array is given, exit.
      if (!data) {
          return;
      }
      // If no search term exists, return the array unfiltered.
      else if (!searchTerm && scope.priceRange==document.getElementById("priceRange").max) {
          return data;
      }
      else if(!searchTerm){
        console.log("one");
        return data.filter(function(item){
              var itemPrice = parseFloat(item.price);
              var itemInPriceRange = itemPrice <= scope.priceRange;
              return itemInPriceRange;
           });
      }
      // Otherwise, continue.
      else {
           // Convert filter text to lower case.
           var term = searchTerm.toLowerCase();

           // Return the array and filter it by looking for any occurrences of the search term in each items id or name. 
           return data.filter(function(item){
              var termInName = item.name.toLowerCase().indexOf(term) > -1;
              var category;
              if(item.category==0){
                category = "Apparel";                
              }
              else{
                category = "Accessories";
              }
              var termInCategory = category.toLowerCase().indexOf(term) > -1;

              var itemInPriceRange = parseFloat(item.price) <= scope.priceRange;
              return (termInName || termInCategory) && itemInPriceRange;
           });
      } 
  }    
});
