async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");
    const japan = { lat: 35.0, lng: 135.3 };

    if (document.getElementById("map") != null) {
        map = new Map(document.getElementById("map"), {
            zoom: 4.8,
            center: japan,
        });
        // 画像の位置情報をマップに配置
        if (catImages.length) {
            catImages.forEach((e) => {
                markerLatLng = {
                    lat: Number(e["catimage"]["map_lat"]),
                    lng: Number(e["catimage"]["map_lng"]),
                };
                var marker = new google.maps.Marker({
                    position: markerLatLng,
                    map: map,
                    title: e["catimage"]["title"],
                });
            });
        }
    }

    if (document.getElementById("formMap") != null) {
        formMap = new Map(document.getElementById("formMap"), {
            center: japan,
            zoom: 4.8,
        });
        // クリックイベントを追加
        formMap.addListener("click", function (e) {
            getClickLatLng(e.latLng, formMap);
        });
    }
}

// フォーム用マップ　位置情報取得用
function getClickLatLng(lat_lng, formMap) {

    // マーカーを全削除
    // var marker = new google.maps.Marker({
    //     position: lat_lng,
    //     map: formMap
    // });
    // marker.setMap(null);
    // marker.setVisible(false);
    // marker = null;

    document.getElementById('lat').value = lat_lng.lat();
    document.getElementById('lng').value = lat_lng.lng();

    // マーカーを設置
    var marker = new google.maps.Marker({
        position: lat_lng,
        map: formMap
    });

    // 座標の中心をずらす
    formMap.panTo(lat_lng);
}

initMap();
