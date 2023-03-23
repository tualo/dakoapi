CREATE OR REPLACE PROCEDURE `createTestsendungen`(IN in_plz varchar(10), IN in_product varchar(20), in in_limit integer)
BEGIN 

    DECLARE mx bigint;
    SET mx = (select max(x) x from ( select substring(id,7,9) x, id from sv_daten where id like '016666__________' ) c);
    if (mx is null) then set mx=0; end if;

    FOR record in (select * from sv_normalized_address where postleitzahl=in_plz ORDER BY RAND() limit in_limit) DO 
        set mx=mx+1;

        insert into sv_daten (
            mandant,
            modell,
            kunde,
            produkt,
            auftrag,
            id,
            datum,
            zeit,
            login,
            sortiergang,
            sortierfach,
            strasse,
            hausnummer,
            plz,
            ort,
            alt_codes,
            width,
            height,
            thickness,
            weight,
            result_article,
            importdate,
            zustellungfruehestens,
            anlieferungfruehestens,
            einspeisername, 
            itemformat,
            einspeiser_auftrag,
            gepl_zustellung,
            checked
        )
        select 
            '0000' mandant,
            'Testsendung' modell,
            '040010198120' kunde,
            in_product produkt,
            curdate() auftrag,
            concat(concat('016666',lpad(mx,9,'0')),calc_upoc_pz(concat('016666',lpad(mx,9,'0')))) id,
            curdate() datum,
            cast(now() as time) zeit,
            getSessionUser() login,
            '1' sortiergang,
            'X' sortierfach,
            record.strasse strasse,
            record.hausnummer hausnummer,
            record.postleitzahl plz,
            record.ort ort,
            '' alt_codes,
            2000 width,
            1050 height,
            5 thickness,
            18 weight,
            '' result_article,
            now() importdate,
            now() zustellungfruehestens,
            now() anlieferungfruehestens,
            'createTestsendungen' einspeisername, 
            'DLANG' itemformat,
            now() einspeiser_auftrag,
            curdate() ,
            1
        ;
        
    END FOR;

    call SV_DATA_NORMALIZED_ADDRESS(curdate(),curdate());
    call SV_DATA_FIND_SORTBOXES(curdate(),'Testsendung');

END //