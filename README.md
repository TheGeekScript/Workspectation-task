# API Endpoints Documentation 

## Authentication

Endpoint: /api/auth

Method: POST

Body:
{
  "email": "test@example.com",
  "password": "1234567890"
}

## Create Post

Endpoint: /api/posts

Method: POST

Authorization: Bearer token

Body:
{
  "title": "Post Title",
  "content": "Post Content"
}

## Read Post

Endpoint: /api/posts/{id}

Method: GET

Authorization: Bearer token

Body:
{
  "id": "123456",
  "title": "Post Title",
  "content": "Post Content"
}

## Update Post

Endpoint: /api/posts/{id}

Method: PUT

Authorization: Bearer token

Body:
{
  "title": "Updated Title",
  "content": "Updated Content"
}

## Delete Post

Endpoint: /api/posts/{id}

Method: DELETE

Authorization: Bearer token
