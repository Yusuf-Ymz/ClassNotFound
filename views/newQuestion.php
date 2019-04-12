<div class="container">
    <h3>New Question:</h3>
    <form action="index.php?action=newQuestion" method="post">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Your title" name="question_title"/>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="question_text" rows="5" placeholder="Your Question"></textarea>
        </div>
        <div class="form-group">
            <select class="browser-default custom-select custom-select-md mb-3" name="question_category_id">
                <option selected
                        value="<?php echo $categories[0]->id(); ?>"><?php echo $categories[0]->html_name(); ?></option>
                <?php for ($i = 1; $i < count($categories); $i++) { ?>
                    <option value="<?php echo $categories[$i]->id(); ?>"><?php echo $categories[$i]->html_name(); ?></option>
                <?php } ?>
            </select>
        </div>
        <?php if (isset($notification)) { ?>
            <p id="notification"> <?php echo $notification; ?> </p>
        <?php } ?>
        <input class="btn btn-dark" type="submit" name="form_question" value="Post Question">
    </form>
</div>