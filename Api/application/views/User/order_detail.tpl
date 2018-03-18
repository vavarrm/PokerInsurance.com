

<main class="page-content this-white" style="background: #F0F0F0"  >
    <!-- Breadcrumbs & Page title-->
    <!--
<section class="container-fluid this-padding this-center" style="height: 300px; background-image: url('/images/bg-image-3.jpg'); background-size: cover; background-position: center"></section>
-->

    <section class=" text-left container " style="background: #fff; position:inherit;padding: 0px; margin-top: 50px"   >
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 this-card" style="margin-bottom: 30px; padding-bottom: 20px">
                <br>

                <center><h5 style="font-weight: bold">  Food Delivery  </h5></center>
                <hr/>
               <div class="this-container">
                   <{foreach from=$status item=row key=index}>
                   <div class="col-xs-6 col-md-4">
                       <p ><span style="font-weight: bold" class="this-hide-small">  ORDER ID :</span>
                           <span class="icon icon-sm icon-primary fa fa-barcode this-hide-large"> : </span>
                           <I><{$row.o_id}></I>
                       </p>
                       <p >
                           <span style="font-weight: bold" class="this-hide-small"> DATE: </span>
                           <span class="icon icon-sm icon-primary fa fa-clock-o this-hide-large">:</span>

                           <i > <{$row.add_datetime}></i>
                       </p>
                   </div>
                       <div class="col-xs-6 col-md-4 this-right">

                           <p ><span class="this-hide-small" style="font-weight: bold"> STATUS: </span> <span
                                       class="icon icon-sm icon-primary fa fa-truck this-hide-large"> :</span>
                               <i class=" this-spin fa fa-refresh" style="color: limegreen"></i>
                               <i > <{$row.o_status}></i>...</p>
                       </div>
                   <{/foreach}>
               </div>
            <hr class="offset-top-10">
                <div class="col-xs-12 this-center">
                    <h6 style="font-weight: bold"><u> INVOICE </u> </h6>
                </div>
                <div class="this-container" style="padding: 0px">

                    <table class="table table-striped table-condensed ">
                        <thead>
                        <tr>
                            <th style="text-align:left; width: 50%; border-bottom: 2px solid #ddd;">Description</th>
                            <th style="text-align:left; width: 12%; border-bottom: 2px solid #ddd;">Quantity</th>
                            <th style="text-align:left; width: 24%; border-bottom: 2px solid #ddd;">Price</th>
                            <th style="text-align:left; width: 26%; border-bottom: 2px solid #ddd;">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody >
                        <{foreach from=$order item=row key=index}>
                        <tr>
                            <td style="text-align:left;"><{$row.f_name}></td>
                            <td style="text-align:left;"><{$row.od_num}></td>
                            <td style="text-align:left;"><{$row.f_large_price}></td>
                            <td style="text-align:left;"><{$row.od_price}></td>
                        </tr>
                            <{/foreach}>
                        <tfoot>
                        <{foreach from=$sum item=row key=index}>
                        <tr>
                            <th>Total : </th>
                            <th></th><th></th>
                            <th style="text-align: left" >$ <{$row.total}></th>
                        </tr>

                        <tr><th>Deliver Fee :</th>
                            <th></th><th></th>
                            <th style="text-align: left" >$ 1.00</th>
                        </tr>

                        <tr>
                            <th  >Grand Total : </th>
                            <th></th><th></th>
                            <th style="text-align: left" >$ <{$row.total+1}></th>
                        </tr>
                            <{/foreach}>
                        </tfoot>
                    </table>

                </div>

                <div class="this-center this-large" style="margin-top: 20px">
                    Thank You!!
                </div>
                <br/><br/><br/><br/>

            </div>
        </div>
    </section>





</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="/js/ResizeSensor.js"></script>
<script type="text/javascript" src="/js/sticky-sidebar.js"></script>
<script>

    jQuery(function($) {

        var $inv=$('#inv');

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
        {
            $cache.removeClass("stuck");
            $inv.addClass('this-hide');
            $inv.hide();

        }
</script>
<script type="text/javascript">
    var stickySidebar = new StickySidebar('#sidebar', {
        topSpacing: 20,
        bottomSpacing: 20,
        containerSelector: '.container',
        innerWrapperSelector: '.sidebar__inner'
    });
    var stickySidebar_ = new StickySidebar('#inv', {
        topSpacing: 20,
        bottomSpacing: 20,
        leftSpacing:20,
        containerSelector: '.container',
        innerWrapperSelector: '.inv'
    });

    var lat="<{$lat}>";
    var lang="<{$lng}>";
    var r_name="<{$r_name}>";

    // The following example creates a marker in Stockholm, Sweden using a DROP

    try {

        var point = {
            lat: lat,
            lng: lang,
        };
        var markerSize = {
            x: 22,
            y: 40
        };


        google.maps.Marker.prototype.setLabel = function(label) {
            this.label = new MarkerLabel({
                map: this.map,
                marker: this,
                text: label
            });
            this.label.bindTo('position', this, 'position');
        };

        var MarkerLabel = function(options) {
            this.setValues(options);
            this.span = document.createElement('span');
            this.span.className = 'map-marker-label';
        };

        MarkerLabel.prototype = $.extend(new google.maps.OverlayView(), {
            onAdd: function() {
                this.getPanes().overlayImage.appendChild(this.span);
                var self = this;
                this.listeners = [
                    google.maps.event.addListener(this, 'position_changed', function() {
                        self.draw();
                    })
                ];
            },
            draw: function() {
                var text = String(this.get('text'));
                var position = this.getProjection().fromLatLngToDivPixel(this.get('position'));
                this.span.innerHTML = text;
                this.span.style.left = (position.x - (markerSize.x / 2)) - (text.length * 3) + 10 + 'px';
                this.span.style.top = (position.y - markerSize.y + 40) + 'px';
            }
        });

        function initialize() {
            var myLatLng = new google.maps.LatLng(point.lat, point.lng);
            var gmap = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom:16,
                center: myLatLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var myMarker = new google.maps.Marker({
                map: gmap,
                position: myLatLng,
                label: r_name,
                draggable: true
            });
        }

        initialize();
    } catch (e) {
        alert(e);
    }


</script>
