<!-- Page Content-->
<style>
    #map {
        height: 100%;
    }
    .stuck {
        position:fixed;

        overflow: auto;
        top: 50px;
        min-width: 255px;


    }
</style>


<main class="page-content" style="background: #F0F0F0">
    <!-- Breadcrumbs & Page title-->

    <section class="container-fluid text-center" style="background: silver;height: 350px;
    background-image:url('http://sihalive.dev.com/demo/images/home-slide-4-1920x800.jpg');
    background-size: cover; background-position: center ">
        <div style="margin-top: 100px" >

        </div>

    </section>
    <section class=" text-left container " style="background: #F0F0F0"   >
        <div class=" row  " >
            <div class="col-sm-12" style="padding: 0px; "  >


                <div class="tab-content" >
                    <div id="home" class="tab-pane fade in active">

                        <div class="col-sm-12 this-margin-bottom" style="padding: 0px;  cursor: pointer;overflow: auto  "  >
                            <div  style="position: relative">



                                <{foreach from=$shopId item=row key=index}>

                                <{if empty($row.r_id)}>
                                <div class="this-container this-padding this-center" style="height: 200px">
                                    <h2> Restaurant Not found </h2>
                                </div>
                                <{else}>


                                <div class=" restaurant-entry  ">
                                    <div class="">
                                        <div class="col-sm-12  this-margin-top this-border this-padding">
                                            <div class="col-sm-9  text-xs-center text-sm-left">
                                                <div class="col-sx-12 col-md-4">
                                                    <a class="img-responsive  " href="/<{$row.r_id}>">
                                                        <img src="/images/category-<{$row.r_id}>-310X260.png" alt="Food logo" class="img-responsive">
                                                    </a>
                                                </div>
                                                <!-- end:Logo -->
                                                <div class="col-xs-12 col-md-8">
                                                    <h5><a href="/restaurant"><{$row.r_name}></a></h5>
                                                    <span style="font-weight: 300;font-size: 14px;    font-family: 'Lato', Helvetica, Arial, sans-serif;">Burgers, American, Sandwiches, Fast Food, BBQ,urgers, American, Sandwiches <a href="#">...</a></span>
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item"><i class="fa fa-check"></i> Min $ 10,00</li>
                                                        <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
                                                    </ul>
                                                </div>
                                                <!-- end:Entry description -->
                                            </div>
                                            <div class="col-sm-3 text-xs-center">
                                                <div class="right-content bg-white">
                                                    <div class="right-review">
                                                        <div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                                        <p> 245 Reviews</p> <a href="/<{$row.r_id}>" class="btn btn-sm​​​​​​​​​​​ this-hover-text-deep-orange this-text-deep-orange" style="border: dashed 1px orangered;">View Menu</a> </div>
                                                </div>
                                                <!-- end:right info -->
                                            </div>
                                        </div>
                                        <!--end:row -->
                                    </div>
                                </div>

                                <{/if}>
                                <{/foreach}>
                            </div>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">

                        <div id="map"></div>

                    </div>

                </div>


            </div>



</main>

