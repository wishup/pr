    <h1>Search Results</h1>
    <?php
    if($search_results):
        foreach($search_results as $result):?>
            <h2><?php echo $result["section_name"];?></h2>
                <h3><?= $result["searchfields"]["title"] ?></h3>
                <p><?= $result["searchfields"]["content"] ?></p>
        <?php endforeach;?>
    <?php else: echo "sorry, nothing found";endif;?>