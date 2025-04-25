<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>
<?= session()->getFlashdata('message') ?>

<form action="api/v1/events/create" method="post" accept-charset="utf-8">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?= set_value('title') ?>">
    <br>

    <label for="body">Description</label>
    <textarea name="description" cols="45" rows="4"><?= set_value('description') ?></textarea>
    <br>

    <label for="body">Location</label>
    <input name="location" type="text" value="<?= set_value('location') ?>">
    <br>

    <label for="body">Date</label>
    <input name="date" type="datetime-local" value="<?= set_value('date') ?>">
    <br>

    <input type="submit" name="submit" value="Create an event" />
</form>

<br />

<?php if (!empty($events) && is_array($events)): ?>
    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <strong>Title:</strong> <?= ($event['title']) ?><br>
                <strong>Description:</strong> <?= ($event['description']) ?><br>
                <strong>Location:</strong> <?= ($event['location']) ?><br>
                <strong>Date:</strong> <?= ($event['date']) ?><br>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No events found.</p>
<?php endif; ?>

<br />