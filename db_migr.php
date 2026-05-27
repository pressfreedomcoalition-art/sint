<?php

/**
 * Ordered DB migrations. Index is migration id.
 */
return [
    "CREATE TABLE IF NOT EXISTS settings (
        id INT PRIMARY KEY,
        last_migration_index INT NOT NULL DEFAULT -1
    )",
    "INSERT INTO settings (id, last_migration_index)
        SELECT 1, -1 FROM DUAL
        WHERE NOT EXISTS (SELECT 1 FROM settings WHERE id = 1)",
    "ALTER TABLE users ADD COLUMN IF NOT EXISTS access_status VARCHAR(16) NOT NULL DEFAULT 'user'",
    "ALTER TABLE ipso MODIFY COLUMN role VARCHAR(32) NOT NULL",
    "ALTER TABLE faggots ADD COLUMN IF NOT EXISTS is_criminal TINYINT(1) NOT NULL DEFAULT 0",
    "ALTER TABLE faggots ADD COLUMN IF NOT EXISTS assigned_ipso_user_id INT NULL",
    "UPDATE faggots SET assigned_ipso_user_id = user_id WHERE assigned_ipso_user_id IS NULL AND user_id IS NOT NULL",
    "ALTER TABLE faggots ADD INDEX IF NOT EXISTS idx_faggots_is_criminal (is_criminal)",
    "ALTER TABLE faggots ADD INDEX IF NOT EXISTS idx_faggots_assigned_ipso_user_id (assigned_ipso_user_id)",
    "CREATE TABLE IF NOT EXISTS criminal_organizations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL UNIQUE
    )",
    "CREATE TABLE IF NOT EXISTS person_criminal_organizations (
        person_id INT NOT NULL,
        organization_id INT NOT NULL,
        PRIMARY KEY (person_id, organization_id),
        INDEX idx_pco_person (person_id),
        INDEX idx_pco_org (organization_id)
    )",
    "INSERT IGNORE INTO criminal_organizations (name) VALUES
        ('Federal Security Service of the Russian Federation (FSB)'),
        ('Foreign Intelligence Service of the Russian Federation (SVR)'),
        ('Federal Protective Service of the Russian Federation (FSO)'),
        ('National Guard of the Russian Federation (Rosgvardiya)'),
        ('Ministry of Defence of the Russian Federation'),
        ('General Staff of the Armed Forces of the Russian Federation'),
        ('Ground Forces of the Russian Federation'),
        ('Aerospace Forces of the Russian Federation'),
        ('Russian Navy'),
        ('Airborne Forces of the Russian Federation (VDV)'),
        ('Main Directorate of the General Staff of the Armed Forces of the Russian Federation (GRU)'),
        ('Military Commissariats of the Russian Federation (Voenkomats)'),
        ('Military Police of the Ministry of Defence of the Russian Federation'),
        ('Federal Penitentiary Service of Russia (FSIN)'),
        ('Ministry of Internal Affairs of the Russian Federation (MVD)'),
        ('Main Directorate for Migration of the Ministry of Internal Affairs of Russia'),
        ('Investigative Committee of the Russian Federation'),
        ('Federal Service for National Guard Troops of the Russian Federation Special Purpose Units'),
        ('Administration of the President of the Russian Federation')",
];

