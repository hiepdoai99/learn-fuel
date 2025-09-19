<?php

namespace Fuel\Migrations;

class Add_provinces_data
{
    public function up()
    {
        $provinces = [
            "Tuyên Quang",
            "Cao Bằng",
            "Lai Châu",
            "Lào Cai",
            "Thái Nguyên",
            "Điện Biên",
            "Lạng Sơn",
            "Sơn La",
            "Phú Thọ",
            "Bắc Ninh",
            "Quảng Ninh",
            "Hà Nội",
            "Hải Phòng",
            "Hưng Yên",
            "Ninh Bình",
            "Thanh Hoá",
            "Nghệ An",
            "Hà Tĩnh",
            "Quảng Trị",
            "Huế",
            "Đà Nẵng",
            "Quảng Ngãi",
            "Gia Lai",
            "Đắk Lắk",
            "Khánh Hòa",
            "Lâm Đồng",
            "Đồng Nai",
            "Tây Ninh",
            "TP Hồ Chí Minh",
            "Đồng Tháp",
            "An Giang",
            "Vĩnh Long",
            "Cần Thơ",
            "Cà Mau",
        ];

        foreach ($provinces as $name) {
            \DB::insert('provinces')->set([
                'name' => $name,
            ])->execute();
        }
    }

    public function down()
    {
        \DB::delete('provinces')->execute();
    }
}
