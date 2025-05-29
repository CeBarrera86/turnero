-- Active: 1715958667580@@127.0.0.1@3306@turnero
USE turnero;

INSERT INTO `roles`(`id`, `tipo`, `descripcion`, `created_at`, `updated_at`) VALUES
    (null, 'Admin', 'Administrador/a', NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 'Gerente', 'Gerente de Sección', NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 'Jefe', 'Jefe/a de Sector', NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND),
    (null, 'Usuario', 'Usuario de Corpico', NOW(), NOW());

INSERT INTO `users`(`id`, `name`, `surname`, `role`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
    (null, 'Noelia', 'Carracedo', '4', 'ncarracedo', NULL, NULL, '$2y$10$kHnuspfr9svjrgJKC8PXpuYarnWt45xSbWRJbDSa/yLfPwVsce2pu', NULL, NOW() - INTERVAL 125 SECOND, NOW() - INTERVAL 125 SECOND),
    (null, 'Valeria', 'Drapanti', '4', 'vdrapanti', NULL, NULL, '$2y$10$pN5z6X3APvmT9MtxSiCd/.R9xmQfJiBAhZ7v2aIvFhVugOkIDKXrK', NULL, NOW() - INTERVAL 105 SECOND, NOW() - INTERVAL 105 SECOND),
    (null, 'Rodrigo', 'Vizcarra', '4', 'rvizcarra', NULL, NULL, '$2y$10$HWlutCPL9Uu/qE3aO21R7uZthDEU2xxEAKTDoDG6TJv7qf6w1qu5C', NULL, NOW() - INTERVAL 115 SECOND, NOW() - INTERVAL 115 SECOND),
    (null, 'Diego', 'Brandan', '4', 'dbrandan', NULL, NULL, '$2y$10$/6LnUHH2GcLSZvhA336NRuHghcZq1Pk5r/Cdy/.R5XOVo216qXazK', NULL, NOW() - INTERVAL 110 SECOND, NOW() - INTERVAL 110 SECOND),
    (null, 'Maira', 'Romero', '4', 'mromero', NULL, NULL, '$2y$10$2cbZUCQw1yXnSCSHFBtNeealALBDhD/O/ARH5voIwEFaQWM6XU9zK', NULL, NOW() - INTERVAL 105 SECOND, NOW() - INTERVAL 105 SECOND),
    (null, 'Cristina', 'Britos', '4', 'cbritos', NULL, NULL, '$2y$10$xBTdVTl20TklJPuaejUATue1YBvWanCWaArvLqZDGRNJwRIM53I4S', NULL, NOW() - INTERVAL 95 SECOND, NOW() - INTERVAL 95 SECOND),
    (null, 'Mariano', 'Martinez', '4', 'mmartinez', NULL, NULL, '$2y$10$9Xb7fpzX.18KWeaIRg6Nj.492zNWWqR7Ku2LR0fX4yg6EPsweRT7u', NULL, NOW() - INTERVAL 120 SECOND, NOW() - INTERVAL 120 SECOND),
    (null, 'Vanina', 'Glatigny', '4', 'vglatigny ', NULL, NULL, '$2y$10$9PV4aZvika6YZFNSi9PxSOUJ4v/Waocb6F3ss4r7AqCFTiltopX9q', NULL, NOW() - INTERVAL 100 SECOND, NOW() - INTERVAL 100 SECOND),
    (null, 'Cecilia', 'Martín', '4', 'cmartin', NULL, NULL, '$2y$10$Ehl3y.A6Ld2wlsI3cRPOoOgMbspAo2zcIzq.sfr4zW.PAZA3U9gQC', NULL, NOW() - INTERVAL 90 SECOND, NOW() - INTERVAL 90 SECOND),
    (null, 'Lucas', 'David', '4', 'ldavid', NULL, NULL, '$2y$10$T5AUWDReLBBfcF5NmhSC8.omWtDaomtLOypYw657tKhdTyU951fNu', NULL, NOW() - INTERVAL 85 SECOND, NOW() - INTERVAL 85 SECOND),
    (null, 'María Belén', 'Corral', '4', 'bcorral', NULL, NULL, '$2y$10$ZHafkHReP9eBx1IWv12ezu08BXJhij4Iht8GGzoPzeF/HfCLJ5hcK', NULL, NOW() - INTERVAL 80 SECOND, NOW() - INTERVAL 80 SECOND),
    (null, 'Natalia', 'Balcarce', '4', 'nbalcarce', NULL, NULL, '$2y$10$YEL6h1Qixzla0PDdllpcfOCR9FW6HaY8B3UsyWT8K/Lz1RmSbugA6', NULL, NOW() - INTERVAL 75 SECOND, NOW() - INTERVAL 75 SECOND),
    (null, 'Sofía', 'Vicente', '4', 'svicente', NULL, NULL, '$2y$10$tCyG7yVvePgzhTLyYM6jlOXS/n4jFCudZ.ZKgGcHuZezUml7goW2m', NULL, NOW() - INTERVAL 70 SECOND, NOW() - INTERVAL 70 SECOND),
    (null, 'Juan Mario', 'Olgiatti', '4', 'jolgiatti', NULL, NULL, '$2y$10$izJXyBDv03w04UUhvuaii.3VuAJZa.1daTvx9q2zUiGzIQWisEJcC', NULL, NOW() - INTERVAL 65 SECOND, NOW() - INTERVAL 65 SECOND),
    (null, 'Julio', 'Martin', '4', 'jmartin', NULL, NULL, '$2y$10$50VgzY3r5UDrbg3vjaC4TuCIHkMXMrlnMNMIBlS6A4mLPp4jEdu4e', NULL, NOW() - INTERVAL 60 SECOND, NOW() - INTERVAL 60 SECOND),
    (null, 'Elena', 'Prieto', '4', 'eprieto', NULL, NULL, '$2y$10$N5TGTjshfNi4EbiLJcRAL.kGUuRXcMvRV7SqA1/i94mp8AsloiiLm', NULL, NOW() - INTERVAL 55 SECOND, NOW() - INTERVAL 55 SECOND),
    (null, 'Natalia', 'Giles', '4', 'ngiles', NULL, NULL, '$2y$10$hPUhA6a0LmHcac8T0biWe.3C0qORuCIjMrzWp3oMFuhelmrDJMJy.', NULL, NOW() - INTERVAL 50 SECOND, NOW() - INTERVAL 50 SECOND),
    (null, 'Evangelina', 'Sojo', '4', 'esojo', NULL, NULL, '$2y$10$f2jXW6JUCNcUymHTRDCLb.HTL.qGH.vd4GQLEk3klrFVzBHjR1IPG', NULL, NOW() - INTERVAL 48 SECOND, NOW() - INTERVAL 48 SECOND),
    (null, 'María Marta', 'Villegas', '3', 'mvillegas', NULL, NULL, '$2y$10$m/77q6B7wXel2vovfM29rueKiHSVc.qGIGCWtkpajopp.xYlV520e', NULL, NOW() - INTERVAL 45 SECOND, NOW() - INTERVAL 45 SECOND),
    (null, 'Laura', 'Cardoso', '3', 'lcardoso', NULL, NULL, '$2y$10$07qpFA1saC/.mEorIgMZiuuCam.c4QVTp9zEVfDsbvBZqj3V/QtdC', NULL, NOW() - INTERVAL 40 SECOND, NOW() - INTERVAL 40 SECOND),
    (null, 'Ruben', 'Corral', '3', 'rcorral', NULL, NULL, '$2y$10$ZcommxjDvMChBJgT.mypkeDAOx2oUshJsSmykw7QyijWgnCbNSDlW', NULL, NOW() - INTERVAL 35 SECOND, NOW() - INTERVAL 35 SECOND),
    (null, 'Fernando', 'Alvarez', '2', 'falvarez', NULL, NULL, '$2y$10$7QTdak9ARngfrD2R36F/Z.mF6pDD9YACheaYbuBDbJ7v3Eg6.8b6.', NULL, NOW() - INTERVAL 30 SECOND, NOW() - INTERVAL 30 SECOND),
    (null, 'Cesar', 'Barerra', '1', 'cbarrera', NULL, NULL, '$2y$10$HBJxvHBLXw7LIzk9ehtyZet9FiUTK.B0X4Xhx9cJ2R8ZW6ICueg5a', NULL, NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 'Milagros', 'Cotal', '4', 'mcotal', NULL, NULL, '$2y$10$.d5GOQZHkqS3ZocVU7DDp.ME6CzqX80zkXq3w4WJFhYWSFQxN3JQK', NULL, NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 'Diego', 'Sanchez', '4', 'dsanchez', NULL, NULL, '$2y$10$TsbAIbkxhlhGjCM23CRiM.yM3L/2DIG/1rMMG8ASI0yDTNVypphT2', NULL, NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND);

INSERT INTO `sectores`(`id`, `letra`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
    (null, 'C', 'CAJAS', 'Pagos / Entregas / SUBE / Prepago', NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 'U', 'USUARIOS', 'Conexiones / Bajas / Extensiones de Línea / Tarifas / Servicios Sociales / Garantías', NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 'R', 'RECLAMOS', 'Reclamos / Consultas / Plazos / Reimpresión de Facturas', NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND),
    (null, 'A', 'ATENCIÓN AL PÚBLICO', 'Gestiones Administrativas en General', NOW(), NOW());

INSERT INTO `tareas`(`id`, `sector`, `descripcion`, `created_at`, `updated_at`) VALUES
    (null, 2,'Altas / Bajas / Presupuesto', NOW() - INTERVAL 25 SECOND, NOW() - INTERVAL 25 SECOND),
    (null, 2,'Garantías', NOW() - INTERVAL 20 SECOND, NOW() - INTERVAL 20 SECOND),
    (null, 2,'Servicios Sociales', NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 3,'Reclamos / Consultas / Plazos / Facturas', NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 3,'Obras (Agua / Cloacas / Alumbrado)', NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND),
    (null, 3,'Sepelio', NOW(), NOW());

INSERT INTO `estados`(`id`, `letra`, `descripcion`, `created_at`, `updated_at`) VALUES
    (null, 'A','ATENDIDO', NOW() - INTERVAL 20 SECOND, NOW() - INTERVAL 20 SECOND),
    (null, 'C','CULMINADO', NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 'D','DERIVADO', NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 'DI','DISPONIBLE', NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND),
    (null, 'E','ELIMINADO', NOW(), NOW());

INSERT INTO `mostradores`(`id`, `numero`, `ip`, `alfa`, `tipo`, `sector`, `created_at`, `updated_at`) VALUES
    (null, 1,'172.16.14.91','C1','CAJA', 1, NOW() - INTERVAL 100 SECOND, NOW() - INTERVAL 100 SECOND),
    (null, 2,'172.16.14.92','C2','CAJA', 1, NOW() - INTERVAL 95 SECOND, NOW() - INTERVAL 95 SECOND),
    (null, 3,'172.16.14.93','C3','CAJA', 1, NOW() - INTERVAL 90 SECOND, NOW() - INTERVAL 90 SECOND),
    (null, 4,'172.16.14.94','C4','CAJA', 1, NOW() - INTERVAL 85 SECOND, NOW() - INTERVAL 85 SECOND),
    (null, 5,'172.16.14.95','C5','CAJA', 1, NOW() - INTERVAL 80 SECOND, NOW() - INTERVAL 80 SECOND),
    (null, 1,'172.16.14.71','B1','BOX', 2, NOW() - INTERVAL 75 SECOND, NOW() - INTERVAL 75 SECOND),
    (null, 2,'172.16.14.72','B2','BOX', 2, NOW() - INTERVAL 70 SECOND, NOW() - INTERVAL 70 SECOND),
    (null, 3,'172.16.14.73','B3','BOX', 2, NOW() - INTERVAL 65 SECOND, NOW() - INTERVAL 65 SECOND),
    (null, 4,'172.16.14.74','B4','BOX', 2, NOW() - INTERVAL 60 SECOND, NOW() - INTERVAL 60 SECOND),
    (null, 5,'172.16.14.75','B5','BOX', 3, NOW() - INTERVAL 55 SECOND, NOW() - INTERVAL 55 SECOND),
    (null, 6,'172.16.14.76','B6','BOX', 3, NOW() - INTERVAL 50 SECOND, NOW() - INTERVAL 50 SECOND),
    (null, 7,'172.16.14.77','B7','BOX', 3, NOW() - INTERVAL 45 SECOND, NOW() - INTERVAL 45 SECOND),
    (null, 8,'172.16.14.78','B8','BOX', 3, NOW() - INTERVAL 40 SECOND, NOW() - INTERVAL 40 SECOND),
    (null, 9,'172.16.14.79','B9','BOX', 2, NOW() - INTERVAL 35 SECOND, NOW() - INTERVAL 35 SECOND),
    (null, 10,'172.16.14.80','B10','BOX', 3, NOW() - INTERVAL 30 SECOND, NOW() - INTERVAL 30 SECOND),
    (null, 11,'172.16.14.81','B11','BOX', 1, NOW() - INTERVAL 25 SECOND, NOW() - INTERVAL 25 SECOND);

ALTER TABLE `mostradores` AUTO_INCREMENT = 100;

INSERT INTO `mostradores`(`id`, `numero`, `ip`, `alfa`, `tipo`, `sector`, `created_at`, `updated_at`) VALUES
    (null, 200,'127.0.0.1','P1','CAJA', 1, NOW() - INTERVAL 20 SECOND, NOW() - INTERVAL 20 SECOND),
    (null, 201,'172.16.14.26','P2','CAJA', 1, NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 202,'172.16.14.25','P3','BOX', 2, NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 203,'172.16.14.24','P4','BOX', 3, NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND),
    (null, 204,'172.16.14.231','P5','CAJA', 1, NOW(), NOW());

INSERT INTO `clientes`(`id`, `dni`, `titular`, `celular`, `email`) VALUES
    (null, 1, 'INVITADO', '02302335555', 'invitado@invitado.com');

INSERT INTO `tickets`(`id`, `letra`, `numero`, `cliente`, `sector`, `estado`, `created_at`, `updated_at`) VALUES
    (null, 'C', 0, 2, 1, 4, NOW() - INTERVAL 95 SECOND, NOW() - INTERVAL 95 SECOND),
    (null, 'R', 0, 3, 3, 4, NOW() - INTERVAL 90 SECOND, NOW() - INTERVAL 90 SECOND),
    (null, 'R', 1, 4, 3, 4, NOW() - INTERVAL 85 SECOND, NOW() - INTERVAL 85 SECOND),
    (null, 'U', 0, 5, 2, 4, NOW() - INTERVAL 80 SECOND, NOW() - INTERVAL 80 SECOND),
    (null, 'C', 1, 1, 1, 4, NOW() - INTERVAL 75 SECOND, NOW() - INTERVAL 75 SECOND),
    (null, 'U', 1, 1, 2, 4, NOW() - INTERVAL 70 SECOND, NOW() - INTERVAL 70 SECOND),
    (null, 'U', 2, 6, 2, 4, NOW() - INTERVAL 65 SECOND, NOW() - INTERVAL 65 SECOND),
    (null, 'C', 2, 7, 1, 4, NOW() - INTERVAL 60 SECOND, NOW() - INTERVAL 60 SECOND),
    (null, 'C', 3, 8, 1, 4, NOW() - INTERVAL 55 SECOND, NOW() - INTERVAL 55 SECOND),
    (null, 'R', 2, 9, 3, 4, NOW() - INTERVAL 50 SECOND, NOW() - INTERVAL 50 SECOND),
    (null, 'U', 3, 1, 2, 4, NOW() - INTERVAL 45 SECOND, NOW() - INTERVAL 45 SECOND),
    (null, 'U', 4, 10, 2, 4, NOW() - INTERVAL 40 SECOND, NOW() - INTERVAL 40 SECOND),
    (null, 'R', 3, 11, 3, 4, NOW() - INTERVAL 35 SECOND, NOW() - INTERVAL 35 SECOND),
    (null, 'C', 4, 12, 1, 4, NOW() - INTERVAL 30 SECOND, NOW() - INTERVAL 30 SECOND),
    (null, 'R', 4, 1, 3, 4, NOW() - INTERVAL 25 SECOND, NOW() - INTERVAL 25 SECOND),
    (null, 'C', 5, 13, 1, 4, NOW() - INTERVAL 20 SECOND, NOW() - INTERVAL 20 SECOND),
    (null, 'C', 6, 1, 1, 4, NOW() - INTERVAL 15 SECOND, NOW() - INTERVAL 15 SECOND),
    (null, 'R', 5, 14, 3, 4, NOW() - INTERVAL 10 SECOND, NOW() - INTERVAL 10 SECOND),
    (null, 'U', 5, 15, 2, 4, NOW() - INTERVAL 5 SECOND, NOW() - INTERVAL 5 SECOND),
    (null, 'U', 6, 1, 2, 4, NOW(), NOW());

