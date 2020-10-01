

@if (!empty($data))
    {{$data->getId()}}
    {{$data->getTitle()}}
    {{$data->getImage()}}
    {{$data->getCategory()}}
    {{$data->getDescription()}}
@endif