@if (!empty($object))
    {{$object->getId()}}
    {{$object->getTitle()}}
    {{$object->getImage()}}
    {{$object->getCategory()}}
    {{$object->getDescription()}}
@endif