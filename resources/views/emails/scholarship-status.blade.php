<!DOCTYPE html>
<html>
<body style="font-family: Arial; padding: 20px;">
    <h2>Namaste {{ $application->user->name }},</h2>
    <p>Aapki scholarship ka status update hua hai.</p>
    <hr>
    <p><b>Scholarship:</b> {{ $application->scholarship->title }}</p>
    <p><b>Status:</b> {{ $application->status }}</p>
    <br>
    <p>Thanks,<br>Tripura Career Team</p>
</body>
</html>