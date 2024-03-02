# :)
**- Tạo CSDL tên là** ```chat```

**- Tạo bảng messages:**
```sql
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `messages` ADD PRIMARY KEY (`id`);
```
