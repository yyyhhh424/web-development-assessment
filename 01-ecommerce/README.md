# E-commerce Entity Relationship Diagram

```mermaid
erDiagram
    CUSTOMERS ||--o{ ADDRESSES : has
    CUSTOMERS ||--o{ ORDERS : places
    CUSTOMERS ||--o{ REVIEWS : writes
    CATEGORIES ||--o{ PRODUCTS : contains
    PRODUCTS ||--o{ ORDER_ITEMS : appears_in
    PRODUCTS ||--o{ REVIEWS : receives
    ORDERS ||--|{ ORDER_ITEMS : contains
    ORDERS ||--o{ PAYMENTS : has
    ORDERS ||--o| SHIPMENTS : has
    ADDRESSES ||--o{ ORDERS : used_for

    CUSTOMERS {
        bigint id PK
        varchar name
        varchar email UK
        varchar password_hash
        varchar phone
        timestamp created_at
        timestamp updated_at
    }

    ADDRESSES {
        bigint id PK
        bigint customer_id FK
        varchar recipient_name
        varchar line1
        varchar line2
        varchar city
        varchar state
        varchar postcode
        varchar country
        boolean is_default
    }

    CATEGORIES {
        bigint id PK
        bigint parent_id FK
        varchar name
        varchar slug UK
        text description
    }

    PRODUCTS {
        bigint id PK
        bigint category_id FK
        varchar sku UK
        varchar name
        text description
        decimal price
        int stock_quantity
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }

    ORDERS {
        bigint id PK
        bigint customer_id FK
        bigint shipping_address_id FK
        varchar order_number UK
        varchar status
        decimal subtotal
        decimal shipping_fee
        decimal tax_amount
        decimal total_amount
        timestamp ordered_at
    }

    ORDER_ITEMS {
        bigint id PK
        bigint order_id FK
        bigint product_id FK
        varchar product_name
        decimal unit_price
        int quantity
        decimal line_total
    }

    PAYMENTS {
        bigint id PK
        bigint order_id FK
        varchar provider
        varchar transaction_reference UK
        decimal amount
        varchar status
        timestamp paid_at
    }

    SHIPMENTS {
        bigint id PK
        bigint order_id FK
        varchar courier
        varchar tracking_number UK
        varchar status
        timestamp shipped_at
        timestamp delivered_at
    }

    REVIEWS {
        bigint id PK
        bigint customer_id FK
        bigint product_id FK
        tinyint rating
        varchar title
        text comment
        timestamp created_at
    }
```

## Relationship summary

- One customer can have many addresses, orders, and reviews.
- One category can contain many products and can optionally have a parent category.
- One order contains one or more order items.
- Products and orders form a many-to-many relationship through `order_items`.
- An order can have multiple payment attempts and zero or one shipment.
