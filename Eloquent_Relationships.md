# Eloquent Relationships

##Defining Relationships
Eloquent relationships are defined as methods on your Eloquent model classes. Since, like Eloquent models themselves, relationships also serve as powerful query builders, defining relationships as methods provides powerful method chaining and querying capabilities. For example, we may chain additional constraints on this posts relationship:
```php
$user->posts()->where('active', 1)->get();
```
But, before diving too deep into using relationships, let's learn how to define each type.
