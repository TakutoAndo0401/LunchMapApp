<h2>みんなで共有！ランチマップ</h2>
Laravelを用いて制作したアプリケーションです。<br>
URL : https://lunchmap-app.herokuapp.com <br>
<br>
<p>画像アップロードについて<p>
    <ul>
     <li>Laravelのファイルストレージを使った方法ではherokuへデプロイするとアップロードしても表示されなくなる。<br></li>
     <li>上の解決策はbase64方式でエンコードして表示。しかし画像が文字列に変わるのでデコード時にかなり重くなる。<br></li>
     <li>S3に画像をアップロードに変更<br></li>
    </ul>
