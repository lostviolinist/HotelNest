<?php
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type = "text/css" href="/css/style.css">
        <title>
            HotelNest
        </title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <div class="homemain">
                        <p class="sign" align="center">Book the perfect room for your trip.  </p>
                        <form class="form1">                             
                            <input class="city" type="text" align="center" placeholder="City">                                
                            <input class="start-date" type="date" align="center" placeholder="start">   to   <input class="end-date" type="date" align="center" placeholder="end">                           
                            <input class="pax" type="number" align="center" placeholder="">   Adults <input class="pax" type="number" align="center" placeholder="">   Child                       
                            <a class="submit" align="center">Search</a>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="recommended">
                        <p>Kuala Lumpur</p>
                            <div class="flex-container">
                                <div class="flex"></div>
                                <?php 
                                    $arr = json_decode(ImageController::getHomeImage("Kuala Lumpur")); 
                                    for($i = 0 ;$i < count($arr); $i++){ ?>
                                        <div>
                                            <img src="<?php print_r($arr[$i]) ?>" alt="st.regis" >
                                            <p>The St.Regis</p>
                                            <p>RM719/night</p>
                                        </div>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>          
    </body>
</html>