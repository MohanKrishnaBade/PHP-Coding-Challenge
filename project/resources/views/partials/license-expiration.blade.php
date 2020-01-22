<?php
$licenseRenewalReminderInDays = \Illuminate\Support\Facades\Config::get('caregivers.license_renewal_reminder_in_days');
[$currentDate, $expirationDate] = [new DateTime(), new DateTime($license_expiration)];
$interval = $currentDate->diff($expirationDate);
$remainingMonths = $interval->format('%m');
$remainingDays = $interval->format('%a');
$formattedDate = sprintf(
    '%d %s %d %s from now',
    $remainingMonths,
    $remainingMonths == 1 ? 'month' : 'months',
    $remainingDays,
    $remainingDays == 1 ? 'day' : 'days');
$className = !$remainingMonths && $remainingDays <= $licenseRenewalReminderInDays ? "badge badge-danger" : "badge badge-warning";
?>

<span class='{{ $className }}'>{{ $formattedDate }}</span>
