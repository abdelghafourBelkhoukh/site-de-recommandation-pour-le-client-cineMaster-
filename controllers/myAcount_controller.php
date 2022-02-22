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
        // $getcomments = new Comments();
        // $commentResult = $getcomments->getComments();
        // $commentRows = mysqli_fetch_all($commentResult);
        // var_dump($commentRows);

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
                                    <label for="recipient-name" class="col-form-label">Add picture:<?php echo $image ?></label>
                                    <input class="form-control" type="file" id="formFile" name="image" accept=".jpg, .jpeg, .png" value="<?php echo $image ?>" />
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


            <div class="post">
                <div class="card">
                    <div class="post-profil d-flex ">
                        <div class="profil">
                            <img class="" src="../images/avatar.webp" alt="images" />
                            <a href=""><?php echo  $firstName . ' ' . $lastName; ?></a>
                        </div>
                        <div class="options">
                            <div class="dropdown">
                                <button <?php if ($authorId != $_SESSION['id']) {
                                            echo 'disabled';
                                        } ?> class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Options
                                </button>
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
                    <!-- <input type="hidden" name="postId" value="<?php //echo $postId ?>"> -->
                    <div class="card-body">
                        <img src="<?php echo $image ?>" class="card-img-top" alt="..." />
                        <h4 class="card-title"><?php echo $title ?></h4>
                        <h6 class=""><?php echo $category ?></h6>
                        <p class="card-text">
                            <?php echo $description ?>
                        </p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn <?php echo 'commentbtn' . $cont ?> " data-bs-toggle="modal" data-bs-target="<?php echo '#commentmodal' . $cont ?>">
                            Add Comment
                        </button>
                        <script>
                            $(document).ready(function() {
                                $(<?php echo '.commentView' . $cont ?>).on('click', function() {
                                    $(<?php echo '#commentsModal' . $cont ?>).modal('show');
                                })
                            })
                        </script>
                        <input type="button" class="btn <?php echo 'commentView' . $cont ?> ms-auto" data-bs-toggle="modal" data-bs-target="<?php echo '#commentsModal' . $cont ?>" data-bs-whatever="comments" value="comments" />
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
                                        <div class="commented-section mt-2">
                                            <div class="d-flex flex-row align-items-center commented-user">
                                                <h5 class="mr-2">Abdelghafour Belkhoukh</h5>
                                            </div>
                                            <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>

                                        </div>

                                    </div>
                                    <div class="modal-body">
                                        <form action="../controllers/myAcount_controller.php" method="post">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo 'commentmodal' . $cont ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../controllers/myAcount_controller.php" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Add comment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="message" placeholder="write a comment..." class="form-control" name="comment" />
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                            <input type="hidden" name="auhorId" value="<?php echo $authorId ?>">
                                            <input type="button" class="btn " data-bs-dismiss="modal" value="Close">
                                            <input type="submit" class="btn " name="addcomment" value="Add">
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    //get post data for update

    function UpdatePosts()
    {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $image = '../images/post/' . $_POST['image'];
        $authorId = $_SESSION['id'];
        $id = $_POST['postId'];
        $Update = new Posts();
        $Update->UpdatePost($title, $category, $description, $image, $id, $authorId);
    }

    function addComment()
    {
        $authorId = $_POST['auhorId'];
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
    $getcomments = new Comments();
    $commentResult = $getcomments->getComments();
    $commentRows = mysqli_fetch_all($commentResult);
    // var_dump($commentRows);
}

//delete post
if (isset($_GET['delete'])) {
    $delete = new MyPosts();
    $delete->deletePosts();
    header('location: ../views/myAcount.php');
}

//update post
if (isset($_POST['submit_update'])) {
    $Edit = new MyPosts();
    $Edit->UpdatePosts();
    header('location: ../views/myAcount.php');
}



// add comment;

if (isset($_POST['addcomment'])) {
    $addComment = new MyPosts();
    $addComment->addComment();
    header('location: ../views/myAcount.php');
}















    ?>