<?php

    if (!session_id()) session_start();
    mysql_connect('127.0.0.1', 'reddit', 'reddit');
    mysql_select_db('reddit');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['url'], $_POST['title'])) {
            if (!storeLink($_POST['title'], $_POST['url'])) {
                $_SESSION['fail'] = 'Your link failed to be added. Is it a real URL? Or maybe it redirects? We need a valid URL that returns a 200 response to a HEAD request.';
            }
        } else if (isset($_POST['votedir'], $_POST['linkid'])) {
            if (ctype_digit($_POST['linkid']) && ctype_digit($_POST['votedir'])) {
                addVote($_POST['linkid'], $_POST['votedir'] ? 1 : -1);
            }
        }
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
    
    function getLink($id) {
        return mysql_fetch_assoc(mysql_query('SELECT * FROM links WHERE id = ' . $id));
    }

    function storeLink($title, $url) {
        //is the URL valid? lol
        $headers = get_headers($url, true);
        if (!preg_match('@^HTTP/1\.[01] 200 OK$@', $headers[0])) {
            return false;
        }
        
        mysql_query('INSERT INTO links (title, url) VALUES (\'' . mysql_real_escape_string($title) . '\', \'' . mysql_real_escape_string($url) . '\')');
        return mysql_insert_id();
    }
    
    function addVote($linkid, $dir) {
        mysql_query('UPDATE links SET votes=votes + ' . $dir . ' WHERE link_id=' . $linkid) or die(mysql_error());
    }
    
    function getAllLinksSorted() {
        //updated the LEFT JOIN
        return mysql_query('SELECT `links`.`title`, `links`.`url`, `links`.`votes` ,`links`.`created_at`,`users`.`username` AS author FROM `links` LEFT JOIN `users` ON `links`.`userid` = `users`.`id` ORDER BY votes DESC');
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <title>Reddit Clone in PHP lol</title>
        <style type="text/css">
            body { background-color: white; color: slategrey; font: 9pt Verdana; }
            a { text-decoration: none; }
            .votes { font-size: 150%; }
            .timestamp { margin-left: 10px; font-size: 80%; }
        </style>
        <script type="text/javascript">
            function submitVote(linkid, dir) {
                document.getElementById("lol").value = dir;
                document.getElementById("lolid").value = linkid;
                document.getElementById("formlulz").submit();
            }
        </script>
    </head>
    <body>
        <h1>Tech Hackers PH.</h1>
        <h2>We are really just a bunch of web developers</h2>
        <h4>This site has nothing to do with hacking in the sense of the penetration of systems</h4>
        <?php if (isset($_SESSION['fail'])) { echo $_SESSION['fail'];  unset($_SESSION['fail']); } ?>
        <form method="post" action="">
            <table>
                <tr><td><label for="url">URL:</label></td><td><input type="text" width="100" name="url" id="url"/></td></tr>
                <tr><td><label for="title">Title:</label></td><td><input type="text" width="100" name="title" id="title"/></td></tr>
                <tr><td></td><td><input type="submit" value="Add Link lol"/></td></tr>
            </table>
        </form>
        
        <form method="post" action="" id="formlulz">
            <input type="hidden" id="lol" name="votedir" value=""/>
            <input type="hidden" id="lolid" name="linkid" value=""/>
        </form>
        
        <table style="margin-top: 20px">
        <?php $result = getAllLinksSorted(); while (($lil = mysql_fetch_assoc($result))) { ?>
            <tr>
                <td>
                    <a href="#" title="upvote lol" onclick="submitVote(<?php echo $lulz['link_id']; ?>, 1); return false;">&uarr;</a>
                    <span class="votes"><?php echo $lil['votes']; ?></span>
                    <a href="#" title="downvote lol" onclick="submitVote(<?php echo $lulz['link_id']; ?>, 0); return false;">&darr;</a>
                </td>
                <td>
                    <a title="problem?" href="<?php echo htmlspecialchars($lil['url'], ENT_QUOTES); ?>"><?php echo htmlentities($lil['title'], ENT_QUOTES); ?></a><br />
                    <span class="timestamp">added on <?php echo date('Y-m-d H:i:s', strtotime($lil['created_at'])); ?> by <?php $lil['username']?></span>
                </td>
            </tr>
        <?php } ?>
        </table>
    </body>
</html>