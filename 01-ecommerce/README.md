# E-commerce Entity Relationship Diagram (v2)

```mermaid
erDiagram
    CUSTOMERS ||--o{ ADDRESSES : has
    CUSTOMERS ||--o{ ORDERS : places
    CUSTOMERS ||--o{ REVIEWS : writes
    CUSTOMERS ||--o| CARTS : owns
    CUSTOMERS ||--o{ WISHLISTS : saves
    CATEGORIES ||--o{ CATEGORIES : parent_of
    CATEGORIES ||--o{ PRODUCTS : contains
    PRODUCTS ||--o{ PRODUCT_IMAGES : has
    PRODUCTS ||--o{ PRODUCT_VARIANTS : has
    PRODUCTS ||--o{ ORDER_ITEMS : appears_in
    PRODUCTS ||--o{ CART_ITEMS : appears_in
    PRODUCTS ||--o{ REVIEWS : receives
    PRODUCTS ||--o{ WISHLISTS : saved_in
    PRODUCTS }o--o{ TAGS : tagged_with
    PRODUCT_VARIANTS ||--o{ ORDER_ITEMS : chosen_as
    PRODUCT_VARIANTS ||--o{ CART_ITEMS : chosen_as
    CARTS ||--|{ CART_ITEMS : contains
    ORDERS ||--|{ ORDER_ITEMS : contains
    ORDERS ||--o{ PAYMENTS : has
    ORDERS ||--o| SHIPMENTS : has
    ORDERS ||--o{ ORDER_STATUS_HISTORY : logs
    ORDERS }o--o| COUPONS : redeems
    ADDRESSES ||--o{ ORDERS : ships_to
    ADDRESSES ||--o{ ORDERS : bills_to
    PAYMENTS ||--o{ REFUNDS : has

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

    PRODUCT_IMAGES {
        bigint id PK
        bigint product_id FK
        varchar image_url
        int sort_order
        boolean is_primary
    }

    PRODUCT_VARIANTS {
        bigint id PK
        bigint product_id FK
        varchar sku UK
        varchar variant_name
        decimal price_adjustment
        int stock_quantity
    }

    TAGS {
        bigint id PK
        varchar name
        varchar slug UK
    }

    PRODUCT_TAGS {
        bigint product_id FK
        bigint tag_id FK
    }

    CARTS {
        bigint id PK
        bigint customer_id FK, UK
        timestamp created_at
        timestamp updated_at
    }

    CART_ITEMS {
        bigint id PK
        bigint cart_id FK
        bigint product_id FK
        bigint variant_id FK
        int quantity
        timestamp added_at
    }

    WISHLISTS {
        bigint id PK
        bigint customer_id FK
        bigint product_id FK
        timestamp added_at
    }

    COUPONS {
        bigint id PK
        varchar code UK
        varchar description
        varchar discount_type
        decimal discount_value
        decimal min_order_amount
        timestamp starts_at
        timestamp expires_at
        int usage_limit
        int times_used
    }

    ORDERS {
        bigint id PK
        bigint customer_id FK
        bigint shipping_address_id FK
        bigint billing_address_id FK
        bigint coupon_id FK
        varchar order_number UK
        varchar status
        decimal subtotal
        decimal shipping_fee
        decimal tax_amount
        decimal discount_amount
        decimal total_amount
        timestamp ordered_at
    }

    ORDER_ITEMS {
        bigint id PK
        bigint order_id FK
        bigint product_id FK
        bigint variant_id FK
        varchar product_name
        decimal unit_price
        int quantity
        decimal line_total
    }

    ORDER_STATUS_HISTORY {
        bigint id PK
        bigint order_id FK
        varchar status
        varchar note
        timestamp changed_at
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

    REFUNDS {
        bigint id PK
        bigint payment_id FK
        decimal amount
        varchar reason
        varchar status
        timestamp refunded_at
    }

    SHIPMENTS {
        bigint id PK
        bigint order_id FK, UK
        varchar courier
        varchar tracking_number
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

- One customer can have many addresses, orders, reviews, and wishlist entries, and owns at most one active cart.
- One category can contain many products and can optionally have a parent category.
- One product can have many images, variants, tags, and reviews.
- A cart or an order holds one or more line items; each line item can optionally point to a specific product variant.
- Products and orders (and products and carts) form many-to-many relationships through their respective item tables.
- An order references two addresses (shipping and billing), can optionally redeem one coupon, and logs every status change it goes through.
- An order can have multiple payment attempts, zero or one shipment, and each payment can have multiple refunds.
