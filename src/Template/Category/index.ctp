<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $category
 */
?>
<?php
  echo $this->Html->script('jquery-3.2.1.min');
  echo $this->Html->script("jquery.easing.1.3");
  echo $this->Html->script('js.util');

  echo $this->Html->script("storage");
  echo $this->Html->script("favorite");
  echo $this->Html->script("history");

  echo $this->Html->script('map');
  echo $this->Html->script('station');
  echo $this->Html->script('nav');
  echo $this->Html->script("sidebar");

  echo $this->Html->css('reset');
  echo $this->Html->css("s/sidebar");
  echo $this->Html->css('s/base');
  echo $this->Html->css('s/map');
  echo $this->Html->css('s/ratioArea');
  echo $this->Html->css('s/radioArea');
  echo $this->Html->css('s/mapStationNav');
?>
<meta name="apple-mobile-web-app-capable" content="yes" />
<div id="sideWrap" style="display:none;">
  <div id="sideListWrap" style="margin-left:-80%;">
    <div id="sideTitle">Baby Map</div>
    <div id="sideList">
      <ul>
        <li onclick="openUrl('https://sites.google.com/view/babysmap-link/%E3%83%9B%E3%83%BC%E3%83%A0')">ようこそ</li>
      </ul>
      <ul>
        <li onclick="babymap.nav.openStationHistory();babymap.sidebar.sideClose();">検索履歴</li>
        <li onclick="babymap.nav.openStationFavorites();babymap.sidebar.sideClose();">お気に入り</li>
      </ul>
      <ul>
        <li onclick="openUrl('https://sites.google.com/view/babysmap-link/%E3%83%98%E3%83%AB%E3%83%97')">ヘルプ</li>
        <li onclick="openUrl('https://sites.google.com/view/babysmap-link/%E5%88%A9%E7%94%A8%E8%A6%8F%E7%B4%84');">利用規約</li>
      </ul>
    </div>
  </div>
<div id="sideBack">

</div>
</div>
<div id="mapStationNav" class="changeroot">
  <div class="changeHeader">
    <!-- header -->
  </div>
  <div id="station-rough" class="changeNav">
    <!-- 簡易 -->
    <div class="access-icon" onclick="babymap.nav.openRoute()">
      <?=$this->Html->image("ac.png");?>
    </div>
    <div class="content" onclick="babymap.nav.openStationDetails()">
      <div class="name">(name)</div>
      <div class="address">(address)</div>
      <div class="categories">
      </div>
    </div>
    <div class="html-toast">
    </div>
  </div>
  <div id="station-details" class="changeNav" style="height:100%;">
    <!-- 詳細 -->
    <div class="header" onclick="babymap.nav.openStationList()">
      <div class="name">(name)</div>
      <div class="address">(address)</div>
    </div>
    <div class="favorite"></div>
    <div style="height:100%;overflow-y: scroll;">
      <div class="accessButton" onclick="babymap.nav.openRoute()">ルート案内</div>
      <div class="comment"><div class="label">概要</div><div class="content">(comment)</div></div>
      <div>
        <div class="facilities">
        </div>
        <!-- <div style="height:30%">
        </div> -->
      </div>
    </div>
    <div class="html-toast">
    </div>
  </div>
  <div id="station-list" class="changeNav">
    <!-- 検索直後のリスト -->
    <div class="header" onclick="babymap.nav.closeStationNav()">
      検索結果:
    </div>
    <div>
      <!-- スクロール用 -->
      <div class="items">
        <div class="stations">
          <!-- Stationの一覧 -->
        </div>
        <div class="default-moreData" style="height:40%">
          <!-- リスト最下端・now Loading… -->
          <div class="nowLoad" style="display:none; height:60px;font-size:40px;padding-top:10px;padding-left:20px;border-left:50px solid red">
            ＠…更新中
          </div>
          <div class="moreData" style="display:block; height:60px;font-size:40px;padding-top:10px;padding-left:20px;border-left:50px solid blue" onclick="babymap.nav.moreData()">
            ＠データ取得
          </div>
        </div>
      </div>
      <div class="html-toast">
      </div>
    </div>
  </div>
  <div id="directions" class="changeNav" onclick='babymap.nav.changeNav("#close-tab")+babymap.nav.stationInfoNav.stop().animate({bottom:"0px","height":"125px"},600,"easeInOutCubic");'>
    <div class="header" style="height: 30px;">
      経路案内
    </div>
    <div style="width: 100%;overflow: scroll;height:100%;touch-action:pan-y;">
      <div id="directions_panel" style="width: 100%;direction: ltr;">

      </div>
      <div style="height:200px"></div>
    </div>
  </div>
  <div id="favorite-list" class="changeNav">
    <!-- 詳細 -->
    <div class="header" onclick="babymap.nav.closeStationNav()">
      お気に入り
    </div>
    <div>
      <!-- スクロール用 -->
      <div class="items">
        <div class="stations">
          <!-- Stationの一覧 -->
        </div>
        <div style="height:40%">
          <!-- リスト最下端 -->
        </div>
      </div>
      <div class="html-toast">
      </div>
    </div>
  </div>
  <div id="history-list" class="changeNav">
    <!-- 詳細 -->
    <div class="header" onclick="babymap.nav.closeStationNav()">
      検索履歴
    </div>
    <div>
      <!-- スクロール用 -->
      <div class="items">
        <div class="contents">
          <!-- Stationの一覧 -->
        </div>
        <div style="height:40%">
          <!-- リスト最下端 -->
        </div>
      </div>
      <div class="html-toast">
      </div>
    </div>
  </div>
  <div id="close-tab" class="changeNav" onclick>
  </div>
</div>
<div id="screen-parent" style="width:200%">

<div class="changeScreen" id="screen-map">
  <div class="searchbox">
    <div class="searchbar">
      <div class="detailbutton">
        <?=$this->Html->image("bars.png");?>
      </div>
      <div class="autobox" style="margin-left: 123px;">
        <!-- <div class="detailbutton inputbox"></div> -->
        <input id="pac-input" class="pac-input-style" type="text" placeholder="場所を検索">
      </div>
    </div>
    <form id="form1" action="" method="get" style="background-color:transparent;margin:0px;margin-top:4px;padding-left:20px">
      <ul class="ratioArea" style="margin:0">
        <?php
          foreach ($category as $key => $value) {
            $id = $value->id;
            $name = $value->name;
            $img = $this->Html->image("icon/$id.png",["class"=>"baby-icon"]);
            echo "<li class='babycategory'><input class='category' id='check{$id}' type='checkbox' name='category[]' value='{$id}'><label for='check{$id}'>$img</label></li>";
          }
        ?>
      </ul>
      <div id="nav-gps" onclick ="babymap.nav.openGps()" style="display:none"><img src="/cakephp/img/now_place2.png"></div>
    </form>
  </div>
</div>

<div class="changeScreen" id="screen-route" style="margin-left:50%;">
  <table class="searchbox" style="border-collapse:separate;border-spacing: 4px;background:pink;border-radius: 0 0 30px 30px;">
    <tr>
      <td rowspan="2" style="vertical-align: top;">
        <?=$this->Html->image("back.png",["onclick"=>"babymap.nav.closeRouteAccess();return false;","width"=>"70px","height"=>"70px","style"=>"filter: brightness(0) invert(1);"]);?></td>
      <td class="searchbar">
        <div class="autobox" style="margin-left: 10px;">
          <!-- <div class="detailbutton inputbox"></div> -->
          <input id="pac-input-src" class="pac-input-style" type="text" placeholder="場所を検索">
        </div>
      </td>
    </tr>
    <tr>
      <td class="searchbar">
        <div class="autobox" style="margin-left: 10px;">
          <!-- <div class="detailbutton inputbox"></div> -->
          <input id="pac-input-dest" class="pac-input-style" type="text" placeholder="場所を検索">
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2" class="travelModeRadio">
        <input type="radio" name="travelMode" value="DRIVING" checked id="travelMode01" />
        <label for="travelMode01" class="radio">車</label>

        <input type="radio" name="travelMode" value="WALKING" id="travelMode02" />
        <label for="travelMode02" class="radio">徒歩</label>

        <input type="radio" name="travelMode" value="BICYCLING" id="travelMode03" />
        <label for="travelMode03" class="radio">自転車</label>

        <input type="radio" name="travelMode" value="TRANSIT" id="travelMode04" />
        <label for="travelMode04" class="radio">公共交通機関</label>
      </td>
    </tr>
  </table>
</div>
</div>
<div id="map" style=""></div>
<script src="https://maps.googleapis.com/maps/api/js?key=YourAPIkey&callback=initMap&libraries=places"></script>
