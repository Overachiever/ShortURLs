<h3><?=$name?></h3>
<table style="margin-bottom:40px;" class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th class="no-wrap">Total Redirects</th>
        <th class="no-wrap">Short URL</th>
        <th>Original URL</th>
        <th>Created On</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($stats as $stat){ ?>
        <tr>
            <td class="no-wrap"><?=$stat->redirects?></td>
            <td class="no-wrap"><a target="_blank" href="<?=$stat->new_url?>"><?=$stat->new_url?></a></td>
            <td class="fill-width"><a target="_blank" href="<?=$stat->url?>"><?=$stat->url?></a></td>
            <td class="no-wrap"><?=date('n/j/Y g:ia', strtotime($stat->created_on))?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>