<?php


namespace api\services\interfaces;


interface CurdInterface
{
    /**
     * 查询接口
     * @param array $data
     * @return mixed
     */
    public function index($data = []);

    /**
     * 添加数据接口
     * @param array $data
     * @return mixed
     */
    public function store($data = []);

    /**
     * 更新数据接口
     * @param array $data
     * @return mixed
     */
    public function update($data = []);

    /**
     * 删除数据接口
     * @param array $data
     * @return mixed
     */
    public function destroy($data = []);

    /**
     * 数据详情接口
     * @param $id
     * @return mixed
     */
    public function show($id);
}