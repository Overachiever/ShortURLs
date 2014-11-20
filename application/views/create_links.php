<div class="jumbotron">
    <h1>Welcome to Link-orama!</h1>
    <p>This is a simple demonstation on how to create tiny urls.  Enter a link below to get started.</p>
    <div class="row">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label for="url">Enter a URL to shorten:</label>
                    <div class="input-group">
                        <input type="text" id="url" name="url" value="<?=$url?>" class="form-control"/>
                        <span class="input-group-btn">
                            <button class="btn btn-success">Create URL</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
