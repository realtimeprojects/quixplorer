
@step(u'I have the reference configuration')
def I_have_the_reference_configuration(step):
    try:
        shutil.copy("test/data/reference/quixplorer.cfg", "src/_config/")
        shutil.copy("test/data/reference/.htusers.php", "src/_config/")
        if os.path.isdir(DATA_DIR):
            shutil.rmtree(DATA_DIR)
        os.makedirs(DATA_DIR)
        shutil.copytree("test/data/reference/download/data", DATA_DIR+"/download", symlinks=True)
    except shutil.Error as err:
        assert False, "%s" % err

