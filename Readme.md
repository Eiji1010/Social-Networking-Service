## ER図
```mermaid
erDiagram
  User {
    int id PK
    string username
    string password
    string introduction
    datetime created_at
    datetime updated_at
  }
```