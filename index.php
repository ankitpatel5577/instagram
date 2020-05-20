<?php
$username = 'drash_nayak';
$instaResult = file_get_contents('https://www.instagram.com/'. $username.'/?__a=1');
$insta = json_decode($instaResult);
$instagram = $insta->graphql->user;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Instagram</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="insta_wrapper">
                <div class="insta_header">
                    <h4>Instagram</h4><h5>by @<?php echo $instagram->username; ?></h5>
                </div>
                <?php foreach ($instagram->edge_owner_to_timeline_media->edges as $inst):
                    ?>
                <div class="insta_body">
                    <table>
                        <tr>
                            <td rowspan="2" class="width45px">
                                <img src="<?php echo $instagram->profile_pic_url; ?>" class="rounded-circle custom_size">
                            </td>
                            <td class="font-siz-09"><b><?php echo $instagram->username; ?></b></td>
                        </tr>
                        <tr class="font-siz-08">
                            <?php if (isset($inst->node->location->name)): ?>
                                <td><?php echo $inst->node->location->name; ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <img src="<?php echo $inst->node->display_url; ?>" class="img-fluid" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="custom_padding">
                                    <i class="fa fa-heart-o"
                                       title="likes"></i>&nbsp;<?php echo $inst->node->edge_liked_by->count ?>
                                    &nbsp;&nbsp;
                                    <i class="fa fa-comment-o"
                                       title="comments"></i>&nbsp;<?php echo $inst->node->edge_media_to_comment->count; ?>
                                </div>
                            </td>
                        </tr>
                        <?php if (isset($inst->node->edge_media_to_caption->edges[0]->node->text)): ?>
                            <tr>
                                <td colspan="2">
                                    <div class="custom_padding">
                                    <span><b><?php echo $inst->node->owner->username; ?></b>
                                    <?php echo $inst->node->edge_media_to_caption->edges[0]->node->text ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="2">
                                <div class="custom_padding">
                                    <?php echo date('M d, Y', $inst->node->taken_at_timestamp); ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
