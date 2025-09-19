<?php

class Controller_Api_Room extends Controller
{
    public function action_index()
    {
        $hotel_id = Input::get('hotel_id');
        if (empty($hotel_id))
        {
            return $this->response_json(['error' => 'hotel_id required'], 400);
        }

        $rooms = Model_Room::find('all', [
            'where'    => [['hotel_id', $hotel_id]],
            'order_by' => ['room_number' => 'asc'],
        ]);

        $result = [];
        foreach ($rooms as $r)
        {
            $result[] = [
                'id'          => $r->id,
                'room_number' => $r->room_number,
                'type'        => $r->type,
                'price'       => $r->price,
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
