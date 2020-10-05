<?php
if (!function_exists('formatJson')) {
    /**
     * Created By: hemin.patel
     * Date: 19-03-2019
     * Description: This function is used to format the services/api response
     * @param $msg
     * @param $success
     * @param $data
     * @return array
     */
    function formatJson($msg = null, $success = false, $data = null)
    {
        $message = array(
            'success' => $success,
            'message' => $msg
        );
        if (empty($success)) {
            $message['error'] = $data;
        } else {
            $message['data'] = $data;
        }
        return $message;
    }
}

if(!function_exists('printAndDie')) {
    /**
     * Created By: hemin.patel
     * Date: 05-06-2019
     * Description: This function is print the collection data and stop the next execution
     * @param array collection
     * @return print the collection
     */
    function printAndDie($data)
    {
        echo "<pre/>";
        print_r($data);
        die;
    }
}
?>