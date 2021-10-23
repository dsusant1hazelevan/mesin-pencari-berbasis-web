<center>
<h1> Regestrasi Artikel </h1>

<form action="" method="post">
<table>
    <tr>
        <td > Judul </td>
        <td> <input type="text" name="judul"> </td>
    </tr>
    <tr>
        <td> Deskripsi </td>
        <td> <input type="text" name="deskripsi"> </td>
    </tr>
    <tr>
        <td> Url </td>
        <td> <input type="text" name="url"> </td>
    </tr>   
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Daftarkan"> </td>
    </tr>    
</table>

</form>

<h4>Copyright 2021 hazel.</h4>
</center>

<?php
include "koneksi.php";

if(isset($_POST['submit'])){
mysqli_query($koneksi, "insert into artikel set 
judul = '$_POST[judul]',
deskripsi = '$_POST[deskripsi]',
url = '$_POST[url]'");

echo "artikel telah didaftarkan. anda bisa kembali ke menu pencarian.";

}

?>
