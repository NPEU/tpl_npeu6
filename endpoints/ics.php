<?php
#echo '<pre>'; var_dump($_GET['event']); echo '</pre>'; exit;
#echo '<pre>'; var_dump(base64_decode($_GET['event'])); echo '</pre>'; exit;
$data = json_decode(base64_decode(urldecode($_GET['event'])));
#echo '<pre>'; var_dump($data); echo '</pre>'; exit;

// Check provided datetimes and stamp them if necessary:
$start_stamp = (!(string) (int) $data->start === $data->start)
             ? strtotime($data->start)
             : $data->start;
$end_stamp   = (!(string) (int) $data->end === $data->end)
             ? strtotime($data->end)
             : $data->end;

$alias       = $data->alias;
$description = htmlspecialchars_decode(str_replace("\n", '\n', $data->description));
$start       = date('Ymd\THis', $start_stamp);
$end         = date('Ymd\THis', $end_stamp);
$location    = $data->location;
$summary     = $data->summary;
$created     = date('Ymd\THis');
$modified    = date('Ymd\THis');
$stamp       = date('Ymd\THis');

#echo '<pre>'; var_dump($start); echo '</pre>';
#echo '<pre>'; var_dump($end); echo '</pre>'; exit;
#echo '<pre>'; var_dump($description); echo '</pre>'; exit;

//This is the most important coding.
header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=$alias.ics");
echo "BEGIN:VCALENDAR\n";
echo "PRODID:-//Microsoft Corporation//Outlook 12.0 MIMEDIR//EN\n";
echo "VERSION:2.0\n";
echo "METHOD:PUBLISH\n";
echo "X-MS-OLK-FORCEINSPECTOROPEN:TRUE\n";
echo "BEGIN:VEVENT\n";
echo "CLASS:PUBLIC\n";
echo "CREATED:$created\n";
echo "LAST-MODIFIED:$modified\n";
echo "DTSTAMP:$stamp\n";
echo "DESCRIPTION:$description\n";
echo "DTEND:$start\n";
echo "DTSTART:$end\n";
echo "LOCATION:$location\n";
echo "PRIORITY:5\n";
echo "SEQUENCE:0\n";
echo "SUMMARY;LANGUAGE=en-us:$summary\n";
echo "TRANSP:OPAQUE\n";
echo "UID:040000008200E00074C5B7101A82E008000000008062306C6261CA01000000000000000\n";
echo "X-MICROSOFT-CDO-BUSYSTATUS:BUSY\n";
echo "X-MICROSOFT-CDO-IMPORTANCE:1\n";
echo "X-MICROSOFT-DISALLOW-COUNTER:FALSE\n";
echo "X-MS-OLK-ALLOWEXTERNCHECK:TRUE\n";
echo "X-MS-OLK-AUTOFILLLOCATION:FALSE\n";
echo "X-MS-OLK-CONFTYPE:0\n";
//Here is to set the reminder for the event.
echo "BEGIN:VALARM\n";
echo "TRIGGER:-PT1440M\n";
echo "ACTION:DISPLAY\n";
echo "DESCRIPTION:Reminder\n";
echo "END:VALARM\n";
echo "END:VEVENT\n";
echo "END:VCALENDAR\n";
?>