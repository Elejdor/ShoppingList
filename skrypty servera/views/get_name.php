
<div style="max-width: 300px; margin: 0 auto;">
    <form id="list" action="?action=add" method="post">
        <div class="alert alert-info">
            <strong>Identifier!</strong> Sharing it you can share shopping lists. It's unique for one.
        </div>
        <input class="bottom10 form-control" type="text" name="identifier" placeholder="Identifier"><br/>
        <a id="ok" class="btn btn-primary btn-lg bottom10" href="">Ok</a>
    </form>
</div>

<script>
$("a#ok").click(function(event)
{
    event.preventDefault();
    $("form").submit();
});
</script>
