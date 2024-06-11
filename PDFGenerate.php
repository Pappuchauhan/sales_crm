<?php
require './Dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFGenerate
{
    public $options;
    public $dompdf;
    public $html;
    public function __construct()
    {
        $this->options = new Options();
        $this->options->set('isHtml5ParserEnabled', true);
        $this->options->set('isRemoteEnabled', true);

        $this->dompdf = new Dompdf($this->options);
    }


    public function generatePDF($file_name)
    {
        // Set the HTML content
        $finalHtml = $this->setHtml();

        // Load the HTML into Dompdf
        $this->dompdf->loadHtml($finalHtml);

        // (Optional) Set up the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait'); // 'portrait' or 'landscape'

        // Render the HTML as PDF
        $this->dompdf->render();
        // Get the generated PDF content
        $pdfOutput = $this->dompdf->output(); 
        $dynamicFileName = "{$file_name}.pdf";
        // Define the file path and name
        $filePath = 'uploads/' . $dynamicFileName;
        // Save the PDF file to the specified path
        file_put_contents($filePath, $pdfOutput);

        // Optionally, you can return the file path or any other relevant information
        return $filePath;
    }


    public function setHtml()
    {
        $headHtml = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hotel Voucher</title>
            <style type="text/css">
                html, body{
                    margin: 0;
                    padding: 0;
                }
                .wrapper{
                    width: 620px;
                    height: 100%;
                    border: solid 1px #333;
                    margin: 0 auto;
                    margin-top: 10px;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 12px;
                }
                .v-head{
                    border-bottom: solid 1px #333;
                }
                h1, h2, h3, h4, h5, h6, p{
                    margin: 0;
                    padding: 0;
                }
            </style>
        </head>
        <body>
            <div class="wrapper">
                <div class="v-head">
        ';

        $headHtml .= $this->html;
        $headHtml .= '</div>
        </div>
    </body>
    </html>';
        return $headHtml;
    }
    /**
     * generate hotel voucher HTML
     */
    public function hotel_voucher($data = [])
    {
        $result =  $this->getVoucherData($data['query_id'], $data['index']);
        $logo = $this->getLogo($result['agent_id']);
        $this->html = '<table cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
            <td style="border-right: solid 1px #333; padding: 10px; width: 70%;">
                <h3 style="margin-bottom: 8px;">Hotel Voucher</h3>
                <p style="margin-bottom: 3px;">Go2ladakh Booking ID: <strong>'.$result['booking_code'].'</strong></p>
                <p style="margin-bottom: 3px;">Hotel ID or Name: <strong>'.$result['hotel']['name'].'</strong></p>
                <p style="margin-bottom: 3px;">Booking Date: <strong>'.date("d-m-Y",strtotime($result['booking_date'])).'</strong></p>
            </td>
            <td style="text-align: right; width: 30%; padding: 10px;">
                <img src="'.$logo.'" alt="go2ladakh-logo" width="150px" />
            </td>
        </tr>
    </table>
</div>
<div class="guest-detail">
    <h3 style="padding: 10px; background: #dfdfd5;">Group Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 33%; font-weight: bold;">Guest/Group Name</td>
            <td style="border-right: solid 1px #333; width: 33%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">No. of Guest</td>
            <td style="width: 33%; font-weight: bold; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333;">Meal Request</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; border-bottom: solid 1px #333; padding: 5px; padding-left: 10px; width: 33%;">' . $result['group_name'] . '</td>
            <td style="border-right: solid 1px #333; border-bottom: solid 1px #333; padding: 5px; padding-left: 10px; width: 33%;">' . $result['no_of_guest'] . '</td>
            <td style="width: 33%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $result['meal_request'] . '</td>
        </tr>
    </table>
</div>
<div class="r-details">
    <h3 style="padding: 10px; background: #dfdfd5;">Rooming Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%; font-weight: bold;">TWIN</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">CWB</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">CNB</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">TRIPLE</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">SINGLE</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">QUAD SHARING</td> 
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%;">' . $result['rooming']['TWIN'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%;">' . $result['rooming']['CWB'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%;">' . $result['rooming']['CNB'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%;">' . $result['rooming']['TRIPLE'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%;">' . $result['rooming']['SINGLE'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%;">' . $result['rooming']['QUAD SHARING'] . '</td> 
        </tr>
    </table>
</div>
<div class="r-details">
    <h3 style="padding: 10px; background: #dfdfd5;">Check In/Check Out Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 14%; font-weight: bold;">Check In</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Check Out</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">No. of Night</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Meal Plan</td>
            <td style="border-right: solid 1px #333; width: 14%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Lunch</td>
            <td style="width: 14%; font-weight: bold; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333;">Status</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; width: 14%;">' . $result['hotel']['check_in'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; width: 14%;">' . $result['hotel']['check_out'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; width: 14%;">' . $this->calculateNights($result['hotel']['check_in'], $result['hotel']['check_out']) . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; width: 14%;">' . $result['hotel']['meal_plan'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; width: 14%;">' . $result['hotel']['lunch'] . '</td>
            <td style="width: 14%; padding: 5px; padding-left: 10px;">' . $result['hotel']['status'] . '</td>
        </tr>
    </table>';
    }

    private function roomingDetails($json_data)
    {
        $guests = json_decode($json_data, true);
        $rooming = [];
        foreach ($guests as $key => $guest) {
            $key = trim($key);
            $rooming["$key"] = $guest;
        }
        return $rooming;
    }

    private function calculateNights($checkIn, $checkOut)
    {
        $checkInDate = new DateTime($checkIn);
        $checkOutDate = new DateTime($checkOut);
        $interval = $checkOutDate->diff($checkInDate);
        $nights = $interval->days;

        return $nights;
    }

    private function getHotelDetails($data, $hotel_index)
    {
        $data = json_decode($data, true); 
        if (isset($data["'night'"][$hotel_index])) {
            return [
                'night' => $this->calculateNights($data["'check_in'"][$hotel_index], $data["'check_out'"][$hotel_index]),
                'amount' => $data["'amount'"][$hotel_index],
                'name' => $data["'name'"][$hotel_index],
                'check_in' => $data["'check_in'"][$hotel_index],
                'check_out' => $data["'check_out'"][$hotel_index],
                'mobile' => $data["'mobile'"][$hotel_index],
                'meal_plan' => 'Half Board',
                'lunch' => 'Not included',
                'status' => 'CNF',
            ];
        } else {
            return [
                'night' => 0,
                'amount' => 0,
                'name' => '',
                'check_in' => '',
                'check_out' => '',
                'mobile' => '',
                'meal_plan' => '',
                'lunch' => '',
                'status' => '',
            ];
        }
    }

    private function getVoucherData($query_id, $index)
    {

        $db = getDbInstance();
        $db->where('id', $query_id);
        $result = $db->getOne("agent_queries");
        // print_r( $result );
        $data = [];
        $data['group_name'] =  $result['name'];
        $data['no_of_guest'] = $result['total_pax'];
        $data['meal_request'] = 'No';
        $data['agent_id'] = $result['created_by'];
        $data['booking_date'] = $result['created_at'];
        $data['booking_code'] = $result['booking_code'];
        $data['rooming'] = $this->roomingDetails($result['person']);
        
        //print_r( $data['rooming']);
        $data['hotel'] = $this->getHotelDetails($result['hotel_details'], $index);
        return $data;
    }

    private function getPackageData($package_id)
    {

        $db = getDbInstance();
        $db->where('package_id', $package_id);
        $db->where('itineary', ['TWIN Fixed', 'CWB Fixed', 'CNB Fixed', 'TRIPLE Fixed', 'SINGLE Fixed', 'QUAD SHARING Fixed'], "NOT IN");
        $result = $db->get("package_details");
        return $result;
    }
    /**
     * generate hotel booking HTML
     */
    public function transport_booking($data = [])
    {
       $logo = $this->getLogo($data['created_by']); 
        $this->html = '<table cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
            <td style="border-right: solid 1px #333; padding: 10px; width: 70%;">
                <h3 style="margin-bottom: 8px;">Hotel Voucher</h3>
                <p style="margin-bottom: 3px;">Go2ladakh Booking ID: <strong>'.$data['booking_code'].'</strong></p>
                <p style="margin-bottom: 3px;">Duration: <strong>'.$data['duration'].'</strong></p>
                <p style="margin-bottom: 3px;">Tour Start Date: <strong>'.date("d-m-Y",strtotime($data['tour_start_date'])).'</strong></p>
            </td>
            <td style="text-align: right; width: 30%; padding: 10px;">
                <img src="'.$logo.'" alt="go2ladakh-logo" width="150px" />
            </td>
        </tr>
    </table>
</div>
<div class="g-detail">
    <h3 style="padding: 10px; background: #dfdfd5;">Group Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 33%; font-weight: bold;">Guest/Group Name</td>
            <td style="border-right: solid 1px #333; width: 33%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">No. of Guest</td>
            <td style="width: 33%; font-weight: bold; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333;">Meal Request</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; border-bottom: solid 1px #333; padding: 5px; padding-left: 10px; width: 33%;">' . $data['name'] . '</td>
            <td style="border-right: solid 1px #333; border-bottom: solid 1px #333; padding: 5px; padding-left: 10px; width: 33%;">' . $data['total_pax'] . '</td>
            <td style="width: 33%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">No</td>
        </tr>
    </table>
</div>
<div class="booking-summary">
    <h3 style="padding: 10px; background: #dfdfd5;">Booking Summary</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%; font-weight: bold;">Duration:</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $data['duration'] . '</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%; font-weight: bold;">Travel Date:</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . date("d-m-Y",strtotime($data['tour_start_date'])) . '</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%; font-weight: bold;">No. of Pax:</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $data['total_pax'] . '</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%; font-weight: bold;">Per Person Cost:</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">Rs.' . round(($data['total_amount'] / $data['total_pax'])) . '</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%; font-weight: bold;">Total Cost:</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">Rs.' . $data['total_amount'] . '</td>
        </tr>
    </table>
</div>
<div class="hotel-details">
    <h3 style="padding: 10px; background: #dfdfd5;">Hotel Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; font-weight: bold;">Day</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Hotel Name</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold; width: 65px;">Check In</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold; width: 65px;">Check Out</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Night</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold; width: 60px;">Meal Plan</td>
            <td style="border-right: solid 1px #333; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Location</td>
            <td style="font-weight: bold; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333;">Contact</td>
        </tr>';
        $h_details =  json_decode($data["hotel_details"], true);
        foreach ($h_details["'name'"] as $key => $name) {
            $this->html .= ' <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . ($key + 1) . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $name . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $h_details["'check_in'"][$key] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $h_details["'check_out'"][$key] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $this->calculateNights($h_details["'check_in'"][$key], $h_details["'check_out'"][$key]) . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">MAP</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $h_details["'location'"][$key] . '</td>
            <td style="padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $h_details["'mobile'"][$key] . '</td>
        </tr>';
        }
        $this->html .= '        
    </table>
</div>
<div class="itineary-details">
    <h3 style="padding: 10px; background: #dfdfd5;">Itineary Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 13%; font-weight: bold;">Day</td>
            <td style="border-right: solid 1px #333; width: 13%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Date</td>
            <td style="border-right: solid 1px #333; width: 13%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Day</td>
            <td style="width: 61%; font-weight: bold; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333;">Short Itineary</td>
        </tr>';
        $results =  $this->getPackageData($data['package_id']);

        foreach ($results as $key => $result) {
            $this->html .= '<tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 13%;">Day ' . $result['day'] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 13%;">' . $h_details["'check_in'"][$key] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 13%;">' . date('l', strtotime($h_details["'check_in'"][$key])) . '</td>
            <td style="width: 61%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">' . $result['itineary'] . '</td>
        </tr>';
        }
        $this->html .= ' 
         
         
    </table>
</div>';
        /*
<div class="inclusion-exclusion-details">
    <h3 style="padding: 10px; background: #dfdfd5;">Inclusions & Exclusions</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%; font-weight: bold;">Inclusions</td>
            <td style="width: 50%; font-weight: bold; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333;">Exclusions</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%;">Permit</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">Bike</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%;">Guide</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">Lunch</td>
        </tr>
        <tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 50%;">Bonfire</td>
            <td style="width: 50%; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px;">Water Bottles</td>
        </tr>
    </table>
</div>'
*/
        $this->html .= '<div class="itineary-details">
    <h3 style="padding: 10px; background: #dfdfd5;">Transport Details</h3>
    <table cellpadding="0" cellspacing="0" style="width: 100%; border-top: solid 1px #333;">
        <tr style="border-bottom: solid 1px #333;">
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 20%; font-weight: bold;">Category</td>
            <td style="border-right: solid 1px #333; width: 20%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">No. of Vehicle</td>
            <td style="border-right: solid 1px #333; width: 20%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Driver Name</td>
            <td style="border-right: solid 1px #333; width: 20%; padding: 5px; padding-left: 10px; border-bottom: solid 1px #333; font-weight: bold;">Mobile No.</td>            
        </tr>';
        $dr_details = json_decode($data['driver_details'], true);
        foreach ($dr_details["'driver'"] as $key => $driver) {
            $this->html .= '<tr>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 20%;">' . $dr_details["'type'"][$key] . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 20%;">1</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 20%;">' . $driver . '</td>
            <td style="border-right: solid 1px #333; padding: 5px; border-bottom: solid 1px #333; padding-left: 10px; width: 20%;">' . $dr_details["'mobile'"][$key] . '</td>
             
        </tr>';
        }


        $this->html .= ' </table>';
    }


    public function sendMailToClient($to, $data = [], $imagePath = '')
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->isHTML(true);
        $mail->Username = GMAIL_USER;
        $mail->Password = GMAIL_PASSWORD;

        // Set sender and recipient
        $mail->setFrom(GMAIL_FROM, "Ladakh DMC");
        $mail->addAddress($to);
        if ($data['type'] == 'voucher') {
            $mail->Subject = 'Go2 find voucher details';
            $mail->Body = "<p>Dear Agent,</p>
            <p>Please find the attachment</p>         
            <p>Thank you,</p>
            <p>Ladakh DMC</p>";
        } elseif ($data['type'] == 'transport') {
            $mail->Subject = 'Go2 find transport details';
            $mail->Body = "<p>Dear Agent,</p>
        <p>Please find the attachment</p>         
        <p>Thank you,</p>
        <p>Ladakh DMC</p>";
        }
        // Set email subject and body


        // Add the image attachment
        if (!empty($imagePath)) {
            $mail->addAttachment($imagePath); // The second parameter is optional and sets the name of the attachment
        }

        $result = $mail->send();
        if (!$result) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

        return $result;
    }
    public function getLogo($agentId)
    {
        if (empty($agentId)) {
            $logo = "uploads/black-logo.png";
        } else {
            $db = getDbInstance();
            $db->where('id', $agentId);
            $result = $db->getOne("agents"); 
            if (isset($result['logo']) && !empty($result['logo'])) {
                $logo =  $result['logo'];
            } else {
                $logo = "uploads/black-logo.png";
            }            
        }
       // echo $logo; die;
       //$imageData;
       $img  = base64_encode(file_get_contents($logo));
        return  'data:image/jpeg;base64,' . $img;
       // return $logoEncode = 
    }
}
