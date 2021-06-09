<?php
    include "link.php";
    $id = $_POST['id'];
    $log = $_POST['wlog'];
    $index = $_POST['index'];
    $sort = $_POST['sort'];
    $contents = array();
    if($id=="home")
    {
        switch($sort)
        {
            case 1: $sql = "select * from commodity "; break;
            case 2: $sql = "select * from commodity order by price"; break;
            case 3: $sql = "select * from commodity order by price desc"; break;
            default : $sql = "select * from commodity";
        }
        $content = array();
        if($result = mysqli_query($link,$sql))
        {
            while($row = mysqli_fetch_assoc($result))
                $content[$row['pid']] = $row;
            mysqli_free_result($result);
        }
        mysqli_close($link);

        echo '<div style = "margin-top:10px"></div>';
        echo ' 
        <div class="container">
            <div class="row justify-content-end">
                <div class="dropdown ">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-display="static" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
                    background-blend-mode: multiply,multiply;">
                    排序
                    </button>
                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton" style="background: rgba(0,0,0,0.4);  ">
                    <a class="dropdown-item text-white" href="#" onclick="cart('."'".$id."'".','.$log.',0,1)">預設</a>
                    <a class="dropdown-item text-white" href="#" onclick="cart('."'".$id."'".','.$log.',0,2)">價格低優先</a>
                    <a class="dropdown-item text-white" href="#" onclick="cart('."'".$id."'".','.$log.',0,3)">價格高優先</a>
                    </div>
                </div>
            </div>
        </div>
        ';
        echo '<div style = "margin-top:10px"></div>';
        echo'<div class="row">';
        $i = 0;
        foreach($content as $value) //content來自  content.php
        {
            if($i<$index*6)
            { 
                $i++; 
                continue;
            }
            if($i >= min(array($index*6+6,count($content)))) 
                break;
            echo '
        
        <div class="col-lg-4 col-md-6 mb-4 px-4">
        
            <div class="card"style="height: 100%;" >
                <a href="item.php?item_id='.$value['pid'].'"><img class="card-img-top object-fit object-fit_scale-down"  src="images/'.$value['file_name'].' " alt="no img"></a>
                <div class="card-body ">
                    <h4 class="card-title">
                        <a style="display : inline-block; text-overflow : ellipsis; overflow: hidden; white-space : nowrap; width : 100%;" href="item.php?item_id='.$value['pid'].'">'.$value['name'].'</a>
                    </h4>
                    <h5>$'.$value['price'].'</h5>
                    
                </div>
                <div class="card-footer">
                <small class="text-muted"><div class="row"><div class="col-6">';
            for($j = 0;$j < 5;$j++)
                echo $j < ($value['star_count']==0?$value['star']:$value['star']/$value['star_count']) ? "&#9733; ":"&#9734; ";echo'</div><div class="col-2 offset-4"><div id="'.$value['pid'].'">';
                if($value['stock']>0)
                    echo'<i class="fa fa-cart-plus fa-lg" onclick="nav_slide('.$log.');cart_1('.$value['pid'].','.$log.')"></i>';
                else{echo'<i class="fas fa-times-circle"></i>';}    
                    echo'</div></div>
                    </div></small>
                </div>
            </div>
        
        </div>
    ';
        $i++;
        }
        echo'</div><div class="row">'; 
        if($index != 0) echo '&emsp;<button class="btn btn-primary" onclick="cart('."'home'".','.$log.','.($index-1).','.$sort.')">
        上一頁
        </button>';
        if(($index+1)*6 < count($content)) echo '&emsp;<button class="btn btn-primary" onclick="cart('."'home'".','.$log.','.($index+1).','.$sort.')">
        下一頁
        </button>';
        echo'</div>';
    }
    else
    {
        switch($sort)
        {
            case 1: $sql = "select * from commodity where cate = '$id'"; break;
            case 2: $sql = "select * from commodity where cate = '$id' order by price"; break;
            case 3: $sql = "select * from commodity where cate = '$id' order by price desc"; break;
            default : $sql = "select * from commodity where cate = '$id'";
        }
        
        if($result = mysqli_query($link,$sql))
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $contents[] = $row;
            }
            mysqli_free_result($result);
        }
        echo '<div style = "margin-top:10px"></div>';
        echo ' 
        <div class="container">
            <div class="row justify-content-end">
                <div class="dropdown ">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-display="static" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
                    background-blend-mode: multiply,multiply;">
                    排序
                    </button>
                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton" style="background: rgba(0,0,0,0.4);  ">
                    <a class="dropdown-item text-white" href="#" onclick="cart('."'".$id."'".','.$log.',0,1)">預設</a>
                    <a class="dropdown-item text-white" href="#" onclick="cart('."'".$id."'".','.$log.',0,2)">價格低優先</a>
                    <a class="dropdown-item text-white" href="#" onclick="cart('."'".$id."'".','.$log.',0,3)">價格高優先</a>
                    </div>
                </div>
            </div>
        </div>
        ';
        echo '<div style = "margin-top:10px"></div>';
        echo'<div class="row">';
        $i = 0;
        foreach($contents as $value) {
            if($i < $index*6){ $i++; continue;}
            if($i >= min(array($index*6+6,count($contents)))) break;
            echo '
            <div class="col-lg-4 col-md-6 mb-4 px-4">
                <div class="card" style="height: 100%;">
                    <a href="item.php?item_id='.$value['pid'].'"><img class="card-img-top object-fit object-fit_scale-down" src="images/'.$value['file_name'].' " alt="no img"></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a style="display : inline-block; text-overflow : ellipsis; overflow: hidden; white-space : nowrap; width : 100%;" href="item.php?item_id='.$value['pid'].'">'.$value['name'].'</a>
                        </h4>
                        <h5>$'.$value['price'].'</h5>

                    </div>
                    <div class="card-footer">
                    <small class="text-muted"><div class="row"><div class="col-6">';
                for($j = 0;$j < 5;$j++)
                    echo $j < ($value['star_count']==0?$value['star']:$value['star']/$value['star_count']) ? "&#9733; ":"&#9734; ";echo'</div><div class="col-2 offset-4"><div id="'.$value['pid'].'">';
                    if($value['stock']>0)
                    echo'<i class="fa fa-cart-plus fa-lg" onclick="nav_slide('.$log.');cart_1('.$value['pid'].','.$log.')"></i>';
                    else{echo'<i class="fas fa-times-circle"></i>';}    
                        echo'</div></div>
                        </div></small>
                </div>
                </div>
            </div>
            ';
        $i++;
        }
        echo'</div><div class="row">';
        if($index != 0) echo '&emsp;<button class="btn btn-primary" onclick="cart('."'".$id."'".','.$log.','.($index-1).','.$sort.')">
        上一頁
        </button>';
        if(($index+1)*6 < count($contents)) echo '&emsp;<button class="btn btn-primary" onclick="cart('."'".$id."'".','.$log.','.($index+1).','.$sort.')">
        下一頁
        </button>';
        echo'</div>';  
        mysqli_close($link);      
    }

?>