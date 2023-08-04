<?php include("includes/config.php"); 
$about = 1;
include("app/gtheader.php");

?>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->


<div class="rws-jobdetailsheader">
    <div class="rws-jdhinner">
        <div class="container">
            <h1>PPE Products</h1>
        </div>
    </div>
</div>



<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <a href="javascript:void(0)"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span> PPE Products</a>
            </div>
        </div>
    </div>
</div>

<div class="rws-content">
<h3 align="center">PPE PRODUCTS</h3>
    <div class="container">

        <!-- product content -->
          
<div class="row">

<style>
    .thumbnail {
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
   transition: 0.3s;
   min-width: 40%;
   border-radius: 5px;
 }

 .thumbnail-description {
   min-height: 40px;
   padding: 0 10px;
 }

 .thumbnail hr{
     margin:0px;
 }

 .thumbnail h4{
     margin:5px 0px;
 }

 .thumbnail #quantity{
    /* width: 20%; */
    height: 35px;
   
 }

 .thumbnail .product-details{
    margin-top: 10px;
 }

 .thumbnail .ti-check{
    background-color: #3c763d;
    color: white;
    border-radius: 25px;
    padding: 3px;
    font-size: 10px;
 }


 .thumbnail-description h4{
     color:black;
 }

 ol.s {list-style-type: none;margin-left: 10%;}




 /* .example {
  margin: 20px;
} */
.example input {
  display: none;
}
.example label {
  /* margin-right: 20px; */
  display: inline-block;
  cursor: pointer;
}

.ex1 span {
  display: block;
  /* padding: 5px 10px 5px 25px; */
  padding: 5px 5px 5px 23px;
  border: 2px solid #ddd;
  border-radius: 5px;
  position: relative;
  transition: all 0.25s linear;
}
.ex1 span:before {
  content: '';
  position: absolute;
  left: 5px;
  top: 50%;
  -webkit-transform: translatey(-50%);
          transform: translatey(-50%);
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: #ddd;
  transition: all 0.25s linear;
}
.ex1 input:checked + span {
  background-color: #fff;
  box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.1);
}

.ex1 .blue input:checked + span {
  color: #00c4ff;
  border-color: #00c4ff;
}
.ex1 .blue input:checked + span:before {
  background-color: #00c4ff;
}

.checkbox, .radio {
    margin-top:0px;
}

@media (min-width: 1200px){
.container {
    width: 1240px;
}
}


</style>
  
  <div class="col-md-12">
    <div class="row space-16">&nbsp;</div>
    <div class="row">

        <!-- product -->
        <div class="col-sm-4">
            <div class="thumbnail">
            <div class="caption text-center" >
                <div class="position-relative">
                <img src="images/ppe/ppe.jpg" style="width:200px;height:200px;" />
                </div>
                <hr>
                <h4 id="thumbnail-label"><b>Boiler Suit</b></h4>
            </div>
            <div class="thumbnail-description smaller">
                <h4>About this product</h4>
                Regular fit and comfortable,
                Available in standard size,
                USES: Food Industry, Factories, Industrial Use, Corporate Wear, Workwear, Safety Coat.
                <br><br>
                <span class="badge">Material - ( Cotton/Mixed )</span><br>
                <span class="badge">Cost - ( On Request )</span>
                <div class="product-details">
                    <div class="row">
                    <div class="col-md-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                    </div>
                    <div class="col-md-9 example ex1">
                     <label for="size">Size </label><br>

                        <label class="radio blue">
                                <input type="radio" value="M" name="group1"/>
                                <span>M</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="L" name="group1"/>
                                <span>L</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="XL" name="group1"/>
                                <span>Xl</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="XXL" name="group1"/>
                                <span>XXl</span>
                        </label>
                    </div>
                    </div>
                </div>

            </div>
            
            <div class="caption card-footer text-center">
                <ul class="list-inline">
                <li><button class="btn btn-primary">Purchase</button></li>
                </ul>
            </div>
            </div>
        </div>
        <!-- product end -->



                <!-- product -->
                <div class="col-sm-4">
            <div class="thumbnail">
            <div class="caption text-center" >
                <div class="position-relative">
                <img src="images/ppe/cook.jpg" style="width:200px;height:200px;" />
                </div>
                <hr>
                <h4 id="thumbnail-label"><b>Cook Uniform</b></h4>
            </div>
            <div class="thumbnail-description smaller">
                <h4>About this product</h4>
                
                The traditional chef's uniform (or chef's whites) includes a toque blanche ("white hat"), white double-breasted jacket, pants in a black-and-white houndstooth pattern, and apron.
                <br><br>
                <span class="badge">Material - ( Cotton/Mixed )</span><br>
                <span class="badge">Cost - ( On Request )</span>
                <div class="product-details">
                    <div class="row">
                    <div class="col-md-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                    </div>
                    <div class="col-md-9 example ex1">
                     <label for="size">Size </label><br>

                        <label class="radio blue">
                                <input type="radio" value="M" name="group2"/>
                                <span>M</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="L" name="group2"/>
                                <span>L</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="XL" name="group2"/>
                                <span>Xl</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="XXL" name="group2"/>
                                <span>XXl</span>
                        </label>
                    </div>
                    </div>
                </div>

            </div>
            
            <div class="caption card-footer text-center">
                <ul class="list-inline">
                <li><button class="btn btn-primary">Purchase</button></li>
                </ul>
            </div>
            </div>
        </div>
        <!-- product end -->



                <!-- product -->
                <div class="col-sm-4">
            <div class="thumbnail">
            <div class="caption text-center" >
                <div class="position-relative">
                <img src="images/ppe/handgloves.jpg" style="width:200px;height:200px;" />
                </div>
                <hr>
                <h4 id="thumbnail-label"><b>Safety Hand Gloves</b></h4>
            </div>
            <div class="thumbnail-description smaller">
                <h4>About this product</h4>
                
                superior grip with a snug fit for small and large hands - work on jobs with ultimate dexterity and precision. these gloves provide the feeling you need to get the job done.
                <br><br>
                <span class="badge">Material - ( Rubber,Polyethylene )</span><br>
                <span class="badge">Cost - ( On Request )</span>
                <div class="product-details">
                    <div class="row">
                    <div class="col-md-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                    </div>
                    <div class="col-md-9 example ex1">
                     <label for="size">Size </label><br>

                        <label class="radio blue">
                                <input type="radio" value="M" name="group3" checked/>
                                <span>Free Size</span>
                            </label>
                            
                        </label>
                    </div>
                    </div>
                </div>

            </div>
            
            <div class="caption card-footer text-center">
                <ul class="list-inline">
                <li><button class="btn btn-primary">Purchase</button></li>
                </ul>
            </div>
            </div>
        </div>
        <!-- product end -->



                <!-- product -->
                <div class="col-sm-4">
            <div class="thumbnail">
            <div class="caption text-center" >
                <div class="position-relative">
                <img src="images/ppe/shoes.jpg" style="width:200px;height:200px;" />
                </div>
                <hr>
                <h4 id="thumbnail-label"><b>Safety Shoes</b></h4>
            </div>
            <div class="thumbnail-description smaller">
                <h4>About this product</h4>
                
                Fine material, perfect design, easy to use, water and heat resistance, pocket friendly, fine finishing. Barton grain leather, lining: Black synthetic cambrelle.
                <br><br>
                <span class="badge">Material - ( Leather )</span><br>
                <span class="badge">Cost - ( On Request )</span>
                <div class="product-details">
                    <div class="row">
                    <div class="col-md-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                    </div>
                    <div class="col-md-9 example ex1">
                     <label for="size">Size </label><br>

                        <label class="radio blue">
                                <input type="radio" value="M" name="group4"/>
                                <span>8</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="L" name="group4"/>
                                <span>9</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="XL" name="group4"/>
                                <span>10</span>
                            </label>
                            <label class="radio blue">
                                <input type="radio" value="XXL" name="group4"/>
                                <span>11</span>
                        </label>
                    </div>
                    </div>
                </div>

            </div>
            
            <div class="caption card-footer text-center">
                <ul class="list-inline">
                <li><button class="btn btn-primary">Purchase</button></li>
                </ul>
            </div>
            </div>
        </div>
        <!-- product end -->



                <!-- product -->
                <div class="col-sm-4">
            <div class="thumbnail">
            <div class="caption text-center" >
                <div class="position-relative">
                <img src="images/ppe/goggle.jpg" style="width:200px;height:200px;" />
                </div>
                <hr>
                <h4 id="thumbnail-label"><b>Safety Goggle</b></h4>
            </div>
            <div class="thumbnail-description smaller">
                <h4>About this product</h4>
                
                Soft nose piece & Light in weight make it extremely comfortable to wear continuously during long shifts. Moreover, The wraparound construction provides a perfect fit and seal..
                <br><br>
                <span class="badge">Material - ( Crystal clear,fiber glasess )</span><br>
                <span class="badge">Cost - ( On Request )</span>
                <div class="product-details">
                    <div class="row">
                    <div class="col-md-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
                    </div>
                    <div class="col-md-9 example ex1">
                     <label for="size">Size </label><br>

                        <label class="radio blue">
                                <input type="radio" value="M" name="group5" checked/>
                                <span>Free Size</span>
                            </label>
                           
                        </label>
                    </div>
                    </div>
                </div>

            </div>
            
            <div class="caption card-footer text-center">
                <ul class="list-inline">
                <li><button class="btn btn-primary">Purchase</button></li>
                </ul>
            </div>
            </div>
        </div>
        <!-- product end -->



               




    </div>
  </div>
</div>

        <!-- product content end -->
        
    </div>
</div>

 

<?php include("app/gtfooter.php"); ?>