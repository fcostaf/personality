import base.BaseTest;
import org.testng.Assert;
import org.testng.annotations.Test;
import pages.MeuSite;

public class MeuSiteTest extends BaseTest {
    @Test
    public void listarCadastro(){
        MeuSite page = new MeuSite( getDriver() );
        page.clicarListaCadastro();
        String resultadoFinal = page.fazAcoisa();
        Assert.assertTrue(resultadoFinal.contains("Épico"));
    }

    @Test
    public void listarQuestionario(){
        MeuSite page = new MeuSite( getDriver() );
        page.clicarListaQuestionario();
        String resultadoFinal = page.fazAcoisa();
        Assert.assertTrue(resultadoFinal.contains("Sou curioso"));
    }
}