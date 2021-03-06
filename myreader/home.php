<?php
include("session.php");
?>

<?php 
include('Includere/connection.php');
$sql = "SELECT * FROM `genres_users` WHERE `email`='$email'";
$datas = $dbh->query($sql);
$count = $datas->rowCount();
if ($count > 0)
{
    if($datas !== false) 
    {
        foreach($datas as $row) 
        {
            $genre_user[] = $row['denumire'];
		}
	} 
}
$dbh = null;
    if(empty($genre_user)) {
        $msg = " You don't have any favorite genres added, so we're showing you random genre recommendations. To add some, go to the settings page!";
        $genre1 = "Thriller";
        $genre2 = "Romance";
    } else {
    $msg = " ";
    if(count($genre_user) == 1){
        $genre1 = $genre_user[mt_rand(0, count($genre_user) - 1)];
        $genre2 = "Thriller";
    } else {
    $genre1 = $genre_user[mt_rand(0, count($genre_user) - 1)];
    $genre2 = $genre_user[mt_rand(0, count($genre_user) - 1)];
    while($genre1 == $genre2) {
        $genre1 = $genre_user[mt_rand(0, count($genre_user) - 1)];
    }
    }
    }

    $genre1_link = str_replace(' ', '+', $genre1);
    $genre2_link = str_replace(' ', '+', $genre2);

$url_genre1 = "https://www.googleapis.com/books/v1/volumes?q= +subject:{$genre1_link}&orderBy=newest&callback=handleResponse";
$url_genre2 = "https://www.googleapis.com/books/v1/volumes?q= +subject:{$genre2_link}&orderBy=newest&callback=handleResponse";

// TODO: check if the genre name has spaces and replace them with '+'

?>

<!DOCTYPE html>
<html>

<head>
    <title>My reader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('menu.php'); ?>
    <script>
    const menu = document.getElementById('menu-home');
    menu.setAttribute('class', 'active');
    </script>
    <div class='right-side'>
        <div class="home-header">
            <h2> Your favorite genre recommendations
        </div>
        <p> <?php echo $msg;?>
        <div class='carrousel' id='carrousel0'>
            <div class='book-cover' id='genre1'>
                <div id='bk'>
                    <h3> <?php echo $genre1;?>
                </div>
            </div>

        </div>

        <div class='carrousel' id='carrousel'>
        <div class='book-cover' id='genre2'>
                <div id='bk'>
                    <h3> <?php echo $genre2;?>
                </div>
            </div>
        </div>
    </div>

    <script>
        if(document.getElementsByTagName('p') == " ") { 
            document.getElementsByTagName('p').style.display == "none";
        }
        
        const app = document.getElementById('carrousel');

        function handleResponse(response) {
            for (var i = 0; i < 6; i++) {
                var item = response.items[i];
                // in production code, item.text should have the HTML entities escaped.
                const ahref = document.createElement('a');
                ahref.href = item.volumeInfo.infoLink;
                const card = document.createElement('div');
                card.setAttribute('class', 'book-cover');

                const cover = document.createElement('img');
                cover.src = item.volumeInfo.imageLinks.smallThumbnail;
                cover.href = item.volumeInfo.infoLink;

                const h2 = document.createElement('h2');
                h2.innerHTML += item.volumeInfo.title;
                const h4 = document.createElement('h4');
                h4.innerHTML += item.volumeInfo.authors;

                app.appendChild(card);
                card.append(ahref);
                ahref.append(cover);
                card.appendChild(h2);
                card.appendChild(h4);
            }

            const app0 = document.getElementById('carrousel0');

            function handleResponse(response) {
                for (var i = 0; i < 6; i++) {
                    var item = response.items[i];
                    // in production code, item.text should have the HTML entities escaped.
                    const ahref = document.createElement('a');
                    ahref.href = item.volumeInfo.infoLink;
                    const card = document.createElement('div');
                    card.setAttribute('class', 'book-cover');

                    const cover = document.createElement('img');
                    cover.src = item.volumeInfo.imageLinks.smallThumbnail;
                    cover.href = item.volumeInfo.infoLink;

                    const h2 = document.createElement('h2');
                    h2.innerHTML += item.volumeInfo.title;
                    const h4 = document.createElement('h4');
                    h4.innerHTML += item.volumeInfo.authors;

                    app0.appendChild(card);
                    card.append(ahref);
                    ahref.append(cover);
                    card.appendChild(h2);
                    card.appendChild(h4);
                }
            }
        }
    </script>
    <script src="<?php echo $url_genre2; ?>">
    </script>
    <script>
        const app0 = document.getElementById('carrousel0');

        function handleResponse(response) {
            for (var i = 0; i < 6; i++) {
                var item = response.items[i];
                // in production code, item.text should have the HTML entities escaped.
                const ahref = document.createElement('a');
                ahref.href = item.volumeInfo.infoLink;
                const card = document.createElement('div');
                card.setAttribute('class', 'book-cover');

                const cover = document.createElement('img');
                cover.src = item.volumeInfo.imageLinks.smallThumbnail;

                const h2 = document.createElement('h2');
                h2.innerHTML += item.volumeInfo.title;
                const h4 = document.createElement('h4');
                h4.innerHTML += item.volumeInfo.authors;

                app0.appendChild(card);
                card.append(ahref);
                ahref.append(cover);;
                card.appendChild(h2);
                card.appendChild(h4);
            }
        }
    </script>

    <script src="<?php echo $url_genre1; ?>">
    </script>
</body>

</html>

