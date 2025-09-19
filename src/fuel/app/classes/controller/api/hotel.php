<?php

class Controller_Api_Hotel extends Controller
{
    public function action_index()
    {
        $province_id = Input::get('province_id');
        if (empty($province_id))
        {
            return $this->response_json(['error' => 'province_id required'], 400);
        }

        $hotels = Model_Hotel::find('all', [
            'where'    => [['province_id', $province_id]],
            'order_by' => ['name' => 'asc'],
        ]);

        $result = [];
        foreach ($hotels as $h)
        {
            $result[] = [
                'id'   => $h->id,
                'name' => $h->name,
            ];
        }

        return $this->response_json($result);
    }

    protected function response_json($data, $status = 200)
    {
        $body = json_encode($data);
        return Response::forge($body, $status)->set_header('Content-Type', 'application/json');
    }
}
