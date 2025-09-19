<?php

namespace Fuel\Tasks;

class Queue
{
    public static function process()
    {
        $jobs = \Model_JobQueue::find('all', [
            'where' => [['status', '=', 'pending']],
            'limit' => 5,
        ]);

        foreach ($jobs as $job) {
            try {
                switch ($job->type) {
                    case 'hotel_image_upload':
                        $payload = json_decode($job->payload, true);
                        $file_tmp = $payload['file_tmp'];
                        $hotel_id = $payload['hotel_id'];

                        $tmp_path  = DOCROOT . 'uploads/tmp/' . $file_tmp;
                        $dest_dir  = DOCROOT . 'uploads/hotels/';
                        $dest_path = $dest_dir . $file_tmp;

                        if (file_exists($tmp_path)) {
                            if (@rename($tmp_path, $dest_path)) {
                                $hotel = \Model_Hotel::find($hotel_id);
                                if ($hotel) {
                                    $hotel->image = $file_tmp;
                                    $hotel->save();
                                }
                                $job->status = 'done';
                            } else {
                                $job->status = 'failed';
                                $job->error  = 'Không move được file từ tmp sang hotels';
                            }
                        } else {
                            $job->status = 'failed';
                            $job->error  = 'Temp file not found: ' . $tmp_path;
                        }

                        break;
                }
            } catch (\Exception $e) {
                $job->status = 'failed';
                $job->error = $e->getMessage();
            }

            $job->processed_at = time();
            $job->save();
        }
    }
}
