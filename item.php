<?php
    include "head.php";
    include "db.php";
    $PRODUCT_ID = $_GET['id'];
    $USER_ID = $_SESSION['user_id'];
    $sql = "SELECT PRODUCT_ID,NAME,DESCRIPTION,IMAGE,COMPANY,PRICE,RATINGS,AVG_RATINGS,flag,OS,WARRANTY,features
                              FROM PRODUCT
                              WHERE (PRODUCT_ID = ".$PRODUCT_ID.")";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $NAME = $rows['NAME'];
            $DESCRIPTION = $rows['DESCRIPTION'];
            $IMAGE = $rows['IMAGE'];
            $COMPANY = $rows['COMPANY'];
            $PRICE = $rows['PRICE'];
            $RATINGS = $rows['RATINGS'];
            $AVG_RATINGS = $rows['AVG_RATINGS'];
            $FLAG = $rows['flag'];
            $OS = $rows['OS'];
            $WARRANTY = $rows['WARRANTY'];
            $FEATURES = $rows['features'];


        }

    }
?>
<script >

    function myFunction() {
        var x = document.getElementById('myDIV');
        if (x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }


    (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

    var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

    $(function(){

        $('#new-review').autosize({append: "\n"});

        var reviewBox = $('#post-review-box');
        var newReview = $('#new-review');
        var openReviewBtn = $('#open-review-box');
        var closeReviewBtn = $('#close-review-box');
        var ratingsField = $('#ratings-hidden');

        openReviewBtn.click(function(e)
        {
            reviewBox.slideDown(400, function()
            {
                $('#new-review').trigger('autosize.resize');
                newReview.focus();
            });
            openReviewBtn.fadeOut(100);
            closeReviewBtn.show();
        });

        closeReviewBtn.click(function(e)
        {
            e.preventDefault();
            reviewBox.slideUp(300, function()
            {
                newReview.focus();
                openReviewBtn.fadeIn(200);
            });
            closeReviewBtn.hide();

        });

        $('.starrr').on('starrr:change', function(e, value){
            ratingsField.val(value);
        });
    });
</script>
<style>
    .animated {
        -webkit-transition: height 0.2s;
        -moz-transition: height 0.2s;
        transition: height 0.2s;
    }

    .stars
    {
        margin: 20px 0;
        font-size: 24px;
        color: #d17581;
    }
</style>
<link href="css/it fireem.css" rel="stylesheet">
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-9">

                <div class="thumbnail">
                    <?php echo " <img class= \"img-responsive\"  src=\"".$IMAGE."\" "; ?>  alt="">
                    <div class="caption-full">
                        <h3 class="pull-right"><span class="label label-default">$<?php echo $PRICE; ?></span></h3>
                        <h4>
                            <?php echo $NAME; ?>
                        </h4>


                        <p>
                            <strong>Manufacturer :</strong>  <?php echo $COMPANY; ?>
                        </p>
                        <p>
                            <strong>Operating System :</strong>  <?php echo $OS; ?>
                        </p>

                        <p>
                            <strong>Warranty :</strong>  <?php echo $WARRANTY; ?>
                        </p>
                        <p>
                            <strong>Features :</strong><?php echo $FEATURES; ?>
                        </p>
                        <p>
                            <strong>Description :</strong><?php echo $DESCRIPTION; ?>
                        </p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right"><strong><?php echo $RATINGS; ?> Reviews</strong></p>
                        <p>
                            <?php
                            for ($i= 1 ; $i <= round($AVG_RATINGS); $i++){
                                    echo "<span class= 'glyphicon glyphicon-star'></span>";
                                    }
                                for ($i = 1 ; $i <= (5 - round($AVG_RATINGS)) ; $i++){
                                    echo "<span class='glyphicon glyphicon-star-empty'></span> ";
                                }?>
                            <span class="label label-default"><?php echo round($AVG_RATINGS,1); ?> Ratings</span>
                        </p>
                    </div>
                </div>

                <div class="well">
                    <?php
                    if($loggedin == TRUE){
                        ?>
                        <div class="text-right">
                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box"><span class="glyphicon glyphicon-comment"></span> Leave a Review</a>
                        </div>
                    <?php

                    }
                    ?>


                    <div class="row" id="post-review-box" style="display:none;">
                        <div class="col-md-12">
                            <form accept-charset="UTF-8" <?php echo  " action=   \"ratings.php?product_id=".$PRODUCT_ID."&flag=22\" ";  ?> method="post">
                                <input id="product_id" name="product_id" type="hidden" value = <?php echo $PRODUCT_ID;?> >
                                <input id="ratings-hidden" name="rating" type="hidden">
                                <select class="form-control" id="sel1" class="text-left" style="width:122px;" name ="user_id">
                                    <option value = 0 >Anonymous</option>
                                    <option value = <?php echo $_SESSION["user_id"];?> ><?php echo $_SESSION["username"];?></option>
                                </select><br>
                                <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

                                <div class="text-right">
                                    <div class="stars starrr" data-rating="0">
                                    </div>

                                    <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                        <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                    <button class="btn btn-success" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <hr>
                    <?php

                        $ratings_sql = "SELECT review,rating,user_id, datediff(now(),time) as date from reviews where product_id = '$PRODUCT_ID' order by date ASC ";
                        $result_ratings = $con->query($ratings_sql);

                        if ($result_ratings->num_rows > 0) {

                            while ($rows = $result_ratings->fetch_assoc()) {


                                $review_ratings = $rows['rating'];
                                $review =  $rows['review'];
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            for ($i= 1 ; $i <= $review_ratings; $i++){
                                echo "<span class= 'glyphicon glyphicon-star'></span>";
                            }
                            for ($i = 1 ; $i <= (5 - $review_ratings) ; $i++){
                                echo "<span class='glyphicon glyphicon-star-empty'></span>";
                            }
                            $user_rating = $rows['user_id'];
                            if($user_rating == 0){
                                echo " Anonymous";
                            }
                            else {
                                $username_sql = "SELECT username from userdetails where user_id = '$user_rating'";
                                $result_username = $con->query($username_sql);
                                while ($rows_username = $result_username->fetch_assoc()) {
                                    echo " ";
                                    echo $rows_username['username'];
                                }
                            }
                            $date = $rows['date'];
                            if($date > 0){
                                echo "<span class=\"pull-right\">".$date." days ago</span>
                                        <p>".$review."</p>
                                    </div>
                                </div>
            
                                <hr>";
                            }
                            else{
                                echo "<span class=\"pull-right\">Today</span>
                                        <p>".$review."</p>
                                    </div>
                                </div>
            
                                <hr>";
                            }
                            }
                            }
                            else{
                               echo " <div class=\"row\">
                        <div class=\"col-md-12\">
                            <p>No Reviews</p>
                        </div>
                    </div> ";
                            }
                            ?>


                </div>

            </div>



            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <?php
                    if($admin == TRUE){
                        echo "<a href=\"update.php?product_id=".$PRODUCT_ID."&flag=1\" class=\"list-group-item\">Update</a>";

                        if($FLAG == 1){
                            echo " <a href=\"delete.php?product_id=".$PRODUCT_ID."&flag=1\" class=\"list-group-item\">Delete</a>";
                        }
                        else{
                            echo " <a href=\"delete.php?product_id=".$PRODUCT_ID."&flag=2\" class=\"list-group-item\">Un-Delete</a>";
                        }

                    }
                    else{
                        if($loggedin == TRUE){
                            $user_id = $_SESSION['user_id'];
                            $product_id = $_GET['id'];
                            $check_cart = "SELECT user_id,product_id 
                                           FROM cart
                                           where user_id = '$user_id' AND product_id ='$product_id'";
                            $result_check_cart = $con->query($check_cart);
                            if ($result_check_cart->num_rows > 0){
                                echo "
                                    <a href= \"addToCart.php?product_id=".$PRODUCT_ID."&flag=0\" class=\"list-group-item active\">Remove from Cart</a>";
                            }
                            else{
                                $check = "SELECT QUANTITY AS count FROM product where product_id = '$product_id' and quantity > 0";

                                $result_check = $con->query($check);
                                if ($result_check->num_rows > 0) {
                                    echo "
                                    <a href= \"addToCart.php?product_id=".$PRODUCT_ID."&flag=1\" class=\"list-group-item active\"><span class=\"glyphicon glyphicon-plus-sign\"></span> Add to Cart</a>";
                                }
                                else{
                                    echo "<a href= \"#\" class=\"list-group-item active\">Out of Stock</a>";
                                }

                            }
                        }
                        else{
                            echo "<a href=\"login.php?error=4\" class=\"list-group-item\">Buy Now</a>
                    <a href=\"login.php?error=4\" class=\"list-group-item\">Add to Cart</a>";
                        }
                    }
                    ?>


                </div>
            </div>

        </div>

    </div>
    <!-- /.container -->


    <!-- /.container -->

    <!-- jQuery -->


    <script src="js/bootstrap.min.js">
        function appendRow()
        {
            var x = 1;
            for(var i=0; i < x; i++)
            {
                var d = document.getElementById('div');
                d.innerHTML = "<input type='text' id='tst"+ x +"'><br >";
            }
            ++x;
        }
    </script>

<?php
include "footer.php";
if(empty($_GET) === false) {
    $res = $_GET['flag'];
    if($res == 1){
        echo '<script language="javascript">';
        echo 'alert("Product Added to Cart Successfully")';
        echo '</script>';
    }
    if($res == 2){
        echo '<script language="javascript">';
        echo 'alert("Product Already Added to Cart")';
        echo '</script>';
    }
    if($res == 3){
        echo '<script language="javascript">';
        echo 'alert("Product Removed from Cart Successfully")';
        echo '</script>';
    }

}

?>


