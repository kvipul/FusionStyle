<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Fusion Style</title>
    <!-- include jquery -->
    <script data-require="jquery@*" data-semver="2.0.3" src="js/jquery-2.0.3.min.js"></script>

    <!-- include bootstrape -->
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="css/bootstrap.min.css" />
    <script data-require="bootstrap@3.1.1" data-semver="3.1.1" src="js/bootstrap.min.js"></script>

    <!-- include angularjs -->
    <script data-require="angular.js@1.3.0" data-semver="1.3.0" src="js/angular.js"></script>
    
    <!-- Include fa fa icon library -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>

    <!-- include third party pagination library -->
    <script src="js/dirPagination.js"></script>

    <!-- include local css file -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- include local js file -->
    <script src="js/script.js"></script>

</head>

<body>
    <div ng-app="fusionStyle" ng-controller="myCtrl">
        <div class="">
            <div class="headContent borderB">
                <div class="left" style="height:100px;padding-right:12%">
                    <span style="overflow: hidden;">
                        <img src="src/mad.jpeg" alt="Fusion Style" height="100px">
                    </span>
                    <span style="color:#fba01c;font-size:30px;vertical-align: top;">Fusion Style</span>
                    <span style="vertical-align: -webkit-baseline-middle;">-Fashion is nothing without people!</span>
                </div>
                <!-- <span style="padding-left:20%"></span> -->
                <div>
                    <div class="test2 borderB" style="font-weight: 800;font-size: 18px;background-color: #7b582e;color: #252020;">Total Filtered Product Count:{{(items | mySearchFilter:this:searchTerm | orderBy:orderByFunction:sortReverse).length}} | API Hits:{{apiHits}}</div>
                    <div class="test2" style="font-weight: 100;background-color: #7b582e;">
                        <input type="text" id="search" ng-model="searchTerm" placeholder="Search (by Name or Category)" style="width:100%;font-size:15px"></input>
                    </div>
                </div>
                
            </div>  
            <div class="maincontent">
                <div ng-show="(items | mySearchFilter:this:searchTerm | orderBy:orderByFunction:sortReverse).length==0"
                    style="font-size:40px;font-family: cursive;margin:40px">
                    No Data Found!
                </div>
                <div dir-paginate="item in items | mySearchFilter:this:searchTerm| orderBy:orderByFunction:sortReverse  | itemsPerPage: 10" pagination-id="product">                    
                    <div class="card left">
                        <div>{{filtereddata.length}}</div>
                        <div>
                            <img src="{{item.image}}" alt="{{item.name}}" width="100%" height="25%">
                        </div>
                        <div>
                            <font face="Comic sans MS" size="5">{{item.name}}</font>
                        </div>
                        <i class="fa fa-money l" aria-hidden="true" style="font-size:30px;color:green;"></i>
                        <span style="font-family: cursive;font-size: large;">   Price: &#8377; {{item.price}}</span>       <!-- &#x20B9; for rupee sign -->
                        <div style="padding-left:30px;color:#823636;font-size:15px">
                            <div ng-if="item.category=='0'">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                Apparel
                            </div>
                            <div ng-if="item.category!='0'">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                Accessories
                            </div>
                        
                            <div ng-if="item.quantity!='0'">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                {{item.quantity}} pcs available
                            </div>
                            <div ng-if="item.quantity=='0'">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                SOLD OUT!
                            </div>
                        </div>
                        <div class="box left" style="background-color:{{item.color}}"></div>
                        <div class="" style="color:{{item.color}};margin:5px;font-size:20px">Color
                                <font style="padding-left:50px;color:black;font-family: monospace;">Rating: {{item.rating}}/5</font>
                        </div>
                        <!-- <div>Rating</div> -->

                        <div style="color:#2f2f7d;margin:3px;font-size:20px;"><u>Description#</u></div>
                        <div class="test2" style="height:5em">{{item.description}}</div>
                    </div>
                </div>
            </div>
            <div style="display: -webkit-inline-box;height:600px;margin:100px"></div>

            <!-- Pagination -->
            <div style="margin-bottom:20px;margin-left:40px;">
                <dir-pagination-controls pagination-id="product"></dir-pagination-controls>           
            </div>
        </div>

        
        <!-- Fixed page elements for filter -->
        <div class="fixed borderB">
            <div class="left smallcard" style="margin-left:50px;border-radius: 4px;">PRICE</div>
            <div class="left smallcard" style="margin-left:50px;border-radius: 1px;">0</div>
            <div class="left smallcard" style="width:400px">                
                <span><input type="range" id="priceRange" name="priceRange" min="0" max="5000" ng-model="priceRange"></span>
            </div>
            <div class="left smallcard" style="border-radius: 1px;">{{priceRange}}</div>


            <div class="left smallcard" style="margin-left:110px;border-radius: 4px;">SORT</div>
            <div class="left" style="padding:8px" ng-click="sortReverse=!sortReverse">
                <a href="" ng-show="sortReverse">
                    <i class="fa fa-sort-numeric-desc" aria-hidden="true" style="font-size:20px;color:black"></i>
                </a>
                <a href="" ng-show="!sortReverse">
                    <i class="fa fa-sort-numeric-asc" aria-hidden="true" style="font-size:20px;color:black"></i>
                </a>
            </div>
            <div class="left smallcard" style="margin-left:50px;padding-left:30px;padding-right:30px">               
                <input type="radio" id="sortvalue" value="price" ng-model="sortvalue" >Price</input>
                <input type="radio" id="sortvalue" value="rating" ng-model="sortvalue" style="margin-left:30px">Rating</input>
            </div>


        </div> 



    </div> 
</body>
</html>