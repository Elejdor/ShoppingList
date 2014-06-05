<?php
$identifier = $_POST['identifier'];
?>
<h1><?php echo $identifier; ?></h1>
<div style="max-width: 300px; margin: 0 auto;">
    <form id="list" action="?action=submit" method="post" accept-charset="UTF-8">
        <div class="alert alert-info">
            <strong>Identifier!</strong> Sharing it you can share shopping lists. It's unique for one.
        </div>
        <input class="bottom10 form-control" type="hidden" name="identifier" value="<?php echo $identifier; ?>"><br/>

    </form>
    <a id="add" class="btn btn-success btn-lg bottom10" href="">Add</a>
    <a id="submit" class="btn btn-primary btn-lg bottom10" href="">Submit</a>
</div>

<script>

    $(document).ready(function()
    {


    });

    $("a#add").click(function(event)
    {
        event.preventDefault();
        addField();
    });

    function addField()
    {
        /*<input class=\"left10\" name=\"chk[]\" type=\"checkbox\" value=\"nothing\"></div>"*/

        $("form#list").append("<div class=\"product bottom10\"><input class=\"newone form-control\" placeholder=\"Product name\" name=\"name[]\" type=\"text\">");

        $("input").each(function()
        {
            if ($(this).hasClass("newone"))
            {
                $(this).keypress(function(event)
                {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                    }
                });

                $(this).keyup(function(event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();

                        addField();
                        $(this).parent().siblings('div.product').last().children('input').focus();

                    }
                });
            }
            $(this).removeClass("newone");
        });

    }

    $("a#submit").click(function(event)
    {
        event.preventDefault();
        $("form").submit();
    });

</script>