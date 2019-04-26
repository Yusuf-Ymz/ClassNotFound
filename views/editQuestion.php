<div class="container">
    <h3>Edit your question:</h3>
</div>
<!-- Edit form -->
<form action="index.php?action=editQuestion" method="post">
    <div class="container">
        <!-- The title-->
        <div class="form-group">
            <input type="text" class="form-control" name="question_title"
                   value="<?php echo $question->html_title(); ?>"/>
        </div>
        <!-- The Subject-->
        <div class="form-group">
            <textarea class="form-control" name="question_subject"
                      rows="5"><?php echo $question->html_subject(); ?></textarea>
        </div>
        <!-- Displaying all categories -->
        <div class="form-group">
            <select class="browser-default custom-select custom-select-md mb-3" name="question_category_id">
                <?php for ($i = 0; $i < count($categories); $i++) { ?>
                    <option <?php if ($categories[$i]->id() == $question->category()) echo "selected"; ?> value="<?php echo $categories[$i]->id(); ?>"><?php echo $categories[$i]->html_name(); ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- If the form is incomplete-->
        <?php if (isset($notification)) { ?>
            <p id="notification"> <?php echo $notification; ?> </p>
        <?php } ?>
        <input type="hidden" name="question_id" value="<?php echo $_POST['question_id']; ?>">
        <input class="btn btn-dark" type="submit" name="form_edit" value="Edit question">
    </div>
</form>