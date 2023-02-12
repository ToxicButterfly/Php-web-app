CREATE TABLE public.departments
(
    xml_id character varying(8),
    parent_xml_id character varying(8),
    name_department character varying(60),
    PRIMARY KEY (xml_id)
);

ALTER TABLE IF EXISTS public.departments
    OWNER to postgres;
	
	
CREATE TABLE public.users
(
    xml_id character varying(8) DEFAULT CN000,
    last_name character varying(30),
    name character varying(30),
    second_name character varying(30),
    department character varying(8),
    work_position character varying(50),
    email character varying(50),
    mobile_phone character varying(20),
    phone character varying(20),
    login character varying(50),
    password character varying(50),
    PRIMARY KEY (xml_id)
);

ALTER TABLE IF EXISTS public.users
    OWNER to postgres;
	
	
CREATE TABLE public.files
(
    id serial NOT NULL,
    file_name character varying(50),
    PRIMARY KEY (id)
);

ALTER TABLE IF EXISTS public.files
    OWNER to postgres;