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

                        <div class="col-sm-12 this-margin-bottom" style=";  cursor: pointer;  "  >
                            <div  style="position: relative">


                                <{foreach from=$search item=row key=index}>



                                    <div class=" restaurant-entry  ">

                                           <div class="col-sm-6 this-margin-top this-border this-padding this-white">
                                               <div class="col-sm-8  text-xs-center text-sm-left">
                                                   <div class="col-sx-12 col-md-6">
                                                       <a class="img-responsive  " href="/<{$row.f_r_id}>">
                                                           <img src="/images/food/1-2-310x260.png" alt="Food logo"
                                                                class="img-responsive">
                                                       </a>
                                                   </div>
                                                   <!-- end:Logo -->
                                                   <div class="col-xs-12 col-md-6">
                                                       <h5><a href="/<{$row.f_r_id}>"><{$row.r_name}></a></h5>
                                                       <ul class="list-inline">
                                                          <li class="list-inline-item"><i class="fa
                                                          fa-check"></i>
                                                               Delivery Fee: $ 1,00</li>
                                                           <li class="list-inline-item"><i class="fa
                                                           fa-motorcycle"></i> 20 min</li>
                                                       </ul>
                                                   </div>
                                                   <!-- end:Entry description -->
                                               </div>
                                               <div class="col-sm-4 text-xs-center">
                                                   <div class="right-content bg-white">
                                                       <div class="right-review">
                                                           <a href="/<{$row.f_r_id}>" class="btn
                                                           btn-sm​​​​​​​​​​​ this-hover-text-deep-orange this-text-deep-orange" style="border: dashed 1px orangered;">View Menu</a> </div>
                                                   </div>
                                                   <!-- end:right info -->
                                               </div>
                                           </div>
                                           <!--end:row -->

                                    </div>


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

