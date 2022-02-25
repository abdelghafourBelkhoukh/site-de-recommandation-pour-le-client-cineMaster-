<?php

require "login_controller.php";

class MyAccount extends LoginController
{
    public $id;
    public $firstName;
    public $lastName;

    function __construct()
    {
        $this->id = $_SESSION['id'];
        $this->firstName = $_SESSION['firstName'];
        $this->lastName = $_SESSION['lastName'];
    }
}

class MyPosts extends Posts
{
    public $title = '';
    public $category = '';
    public $description = '';
    public $image = '';
    public $authorId = '';

    function sendPostData()
    {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $image = '../images/post/' . $_POST['image'];
        $authorId = $_SESSION['id'];

        $create = new Posts();
        $create->createPost($title, $category, $description, $image, $authorId);
    }

    function getpost()
    {
        $getpost = new Posts();
        $resu = $getpost->getPosts();
        $rows = mysqli_fetch_all($resu);
        $Length = mysqli_num_rows($resu);
        $cont = 0;
        for ($i = 0; $i < $Length; $i++) {

            //get posts data
            $postId = $rows[$i][0];
            $authorId = $rows[$i][1];
            $image = $rows[$i][2];
            $title = $rows[$i][3];
            $category = $rows[$i][4];
            $description = $rows[$i][5];
            $cont += 1;

            //get author Name
            $authorName = new Posts();
            $result = $authorName->getAuthorName($authorId);
            $FullName = mysqli_fetch_assoc($result);
            $firstName = $FullName['firstName'];
            $lastName = $FullName['lastName'];
?>

            <!-- pop up form modal (update) ########################################################################################################################################## -->

            <div class="modal fade " id="<?php echo 'editmodal' . $cont ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Edit Post
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controllers/myAcount_controller.php" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="idP" value="<?php echo 'idP' . $cont ?>">
                                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" id="recipient-name" value="<?php echo $title ?>" name="title" />
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Category:</label>
                                    <select class="form-select form-control" aria-label="Default select example" name="category" value="<?php echo $category ?>">
                                        <option <?php if ($category === 'choose category') {
                                                    echo 'selected';
                                                } ?>>choose category</option>
                                        <option value="Movie" <?php if ($category === 'Movie') {
                                                                    echo 'selected';
                                                                } ?>>Movie</option>
                                        <option value="Serie" <?php if ($category === 'Serie') {
                                                                    echo 'selected';
                                                                } ?>>Serie</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea type="text" class="form-control" id="message-text" name="description" value=""><?php echo $description ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Add picture:</label>
                                    <input class="form-control" type="file" id="formFile" name="image" accept=".jpg, .jpeg, .png" />
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-secondary" value="Update" name="submit_update">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- ########################################################################################################################################## -->

            <div class="post">
                <div class="card" id="<?php echo 'idP' . $cont ?>">
                    <div class="post-profil d-flex ">
                        <div class="profil">
                            <img class="" src="../images/avatar.webp" alt="images" />
                            <a href=""><?php echo  $firstName . ' ' . $lastName; ?></a>
                        </div>
                        <div class="options">
                            <div class="dropdown">
                                <a <?php if ($authorId != $_SESSION['id']) {
                                        echo 'style="display: none;"';
                                    } ?> class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i style="margin-right: 19px; font-size: 23px;" class="fa-solid fa-ellipsis"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><input style="MARGIN-LEFT: 9%;" type="button" class="btn <?php echo 'editbtn' . $cont ?>" data-bs-toggle="modal" data-bs-target="<?php echo '#editmodal' . $cont ?>" data-bs-whatever="Update" value="Edit" />
                                        <script>
                                            $(document).ready(function() {
                                                $(<?php echo '.editbtn' . $cont ?>).on('click', function() {
                                                    $(<?php echo '#editmodal' . $cont ?>).modal('show');
                                                })
                                            })
                                            $(document).ready(function() {
                                                $(<?php echo '.commentbtn' . $cont ?>).on('click', function() {
                                                    $(<?php echo '#commentmodal' . $cont ?>).modal('show');
                                                })
                                            })
                                        </script>
                                    </li>
                                    <li><a href="../controllers/myAcount_controller.php?delete=<?php echo $postId ?>"><button class="btn">delete</button></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body  pt-0">
                        <div class="modal-content bg-light py-3 px-2">
                            <h4 class="card-title ps-3"><?php echo $title ?></h4>
                            <h6 class="ps-3"><?php echo $category ?></h6>
                            <p class="card-text ps-3">
                                <?php echo $description ?>
                            </p>
                            <img src="<?php echo $image ?>" class="card-img-top" alt="..." />
                        </div>
                        <!-- pop up comment -->
                        <a type="button" class="<?php echo 'commentView' . $cont ?> mt-4 ps-2 text-dark" data-bs-toggle="modal" data-bs-target="<?php echo '#commentsModal' . $cont ?>" data-bs-whatever="comments">All Comments</a>
                        <div class="modal fade " id="<?php echo 'commentsModal' . $cont ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Comments
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-header">
                                        <div class="modal-content mt-4 bg-light">
                                            <?php
                                            //get acc array 
                                            $getcomments = new Comments();
                                            $commentResult = $getcomments->getComments();
                                            $commentRows = mysqli_fetch_all($commentResult, MYSQLI_ASSOC);
                                            foreach ($commentRows as $comment) {
                                                //set all commnents for this post
                                                if ($comment['postID'] == $postId) {
                                            ?>
                                                    <div class="modal-header">
                                                        <div class="commented-section mt-2 " >
                                                            <div class="d-flex flex-row align-items-center commented-user">
                                                                <div class="profil">
                                                                    <!-- <img class="" src="../images/avatar.webp" alt="images" /> -->
                                                                    <h6 class="mr-2"><?php echo $comment['firstName'] . ' ' . $comment['lastName'] ?></h6>

                                                                </div>
                                                            </div>
                                                            <div class="comment-text-sm"><span><?php echo $comment['comment'] ?></span></div>
                                                        </div>
                                                        <div class="options">
                                                            <div class="dropdown ">
                                                                <a <?php if ($comment['authorID'] != $_SESSION['id']) {
                                                                        echo 'style="display: none;"';
                                                                    } ?> href="../controllers/myAcount_controller.php?deleteComment=<?php echo $comment['id'] ?>" class="" style="color: black;" type="button">
                                                                    <i style="margin-right: 19px;color:black" class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
                                            <form action="../controllers/myAcount_controller.php" method="POST">
                                                <div class="modal-body d-flex" >
                                                    <input type="message" placeholder="write a comment..." class="form-control me-3" name="comment" />
                                                    <input type="hidden" name="idPC" value="<?php echo 'idPC' . $cont ?>">
                                                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                                    <input type="hidden" name="auhorId" value="<?php echo $authorId ?>">
                                                    <input type="submit" class="btn " name="addcomment" value="Add" required>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="modal-body">
                                        <form action="../controllers/myAcount_controller.php" method="post">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-content mt-1 bg-light">
                            <?php
                            $ContComment = 0;
                            foreach ($commentRows as $comment) {
                                //set 3 commnents for this post
                                if ($comment['postID'] == $postId && $ContComment < 3) {
                                    $ContComment++; ?>
                                    <div class="modal-header">
                                        <div class="commented-section mt-2 " id="<?php echo 'idPC' . $cont ?>">
                                            <div class="d-flex flex-row align-items-center commented-user">
                                                <div class="profil">
                                                    <!-- <img class="" src="../images/avatar.webp" alt="images" /> -->
                                                    <h6 class="mr-2"><?php echo $comment['firstName'] . ' ' . $comment['lastName'] ?></h6>

                                                </div>
                                            </div>
                                            <div class="comment-text-sm"><span><?php echo $comment['comment'] ?></span></div>
                                        </div>
                                        <div class="options">
                                            <div class="dropdown">
                                                <a <?php if ($comment['authorID'] != $_SESSION['id']) {
                                                        echo 'style="display: none;"';
                                                    } ?> href="../controllers/myAcount_controller.php?deleteComment=<?php echo $comment['id'] ?>" class="" style="color: black;" type="button">
                                                    <i style="margin-right: 19px;color:black" class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                            <form action="../controllers/myAcount_controller.php" method="POST">
                                <div class="modal-body d-flex">
                                    <input type="message" placeholder="write a comment..." class="form-control me-3" name="comment" />
                                    <input type="hidden" name="idPC" value="<?php echo 'idPC' . $cont ?>">
                                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                    <input type="hidden" name="auhorId" value="<?php echo $authorId ?>">
                                    <input type="submit" class="btn " name="addcomment" value="Add">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
    <?php
        }
    }



    function deletePosts()
    {
        $id = $_GET['delete'];
        $delete = new Posts;
        $delete->deletePost($id, $_SESSION['id']);
    }

    function deleteComment()
    {
        $id = $_GET['deleteComment'];
        $deleteComment = new Comments;
        $deleteComment->deleteComment($id, $_SESSION['id']);
    }
    //get post data for update

    function UpdatePosts()
    {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $image = '../images/post/' . $_POST['image'];
        $authorId = $_SESSION['id'];
        $id = $_POST['postId'];
        if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
            $Update = "UPDATE `posts` SET `image`='$image',`title`='$title',`category`='$category',`description`='$description' WHERE `id`=$id and `authorID`=$authorId; ";
        } else {
            $Update = "UPDATE `posts` SET `title`='$title',`category`='$category',`description`='$description' WHERE `id`=$id and `authorID`=$authorId; ";
        }
        $Edit = new Posts();
        $Edit->UpdatePost($Update);
    }

    function addComment()
    {
        $authorId = $_SESSION['id'];
        $postId = $_POST['postId'];
        $comment = $_POST['comment'];
        $addcomment = new comments();
        $addcomment->addComment($postId, $comment, $authorId);
    }
}

//add post
if (isset($_POST['AddPost'])) {
    $post = new MyPosts();
    $post->sendPostData();
    header('location: ../views/myAcount.php');
}

//set posts and comment
if (isset($_SESSION['id'])) {
    $getpost = new MyPosts();
}

//delete post
if (isset($_GET['delete'])) {
    $delete = new MyPosts();
    $delete->deletePosts();
    header('location: ../views/myAcount.php');
}

//update post
if (isset($_POST['submit_update'])) {
    $idP=$_POST['idP'];
    $Edit = new MyPosts();
    $Edit->UpdatePosts();
    header('location: ../views/myAcount.php#'.$idP);
}



// add comment;

if (isset($_POST['addcomment'])) {
    $idPC=$_POST['idPC'];
    $addComment = new MyPosts();
    $addComment->addComment();
    $_SESSION['color'] = 'success';
    header('location: ../views/myAcount.php#'.$idPC);
}

//delete comment
if (isset($_GET['deleteComment'])) {
    $deleteComment = new MyPosts();
    $deleteComment->deleteComment();
    header('location: ../views/myAcount.php');
}

    ?>