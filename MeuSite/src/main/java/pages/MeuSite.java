package pages;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

public class MeuSite extends BasePage {
    @FindBy(xpath = "/html/body/button[2]")
    private WebElement btnListarCadastro;

    @FindBy(xpath = "/html/body/button[4]")
    private WebElement btnListarQuestionario;

    @FindBy(xpath = "/html/body/a")
    private WebElement btnVoltar;


    public MeuSite(WebDriver driver) {
        super(driver);
    }


    public MeuSite clicarListaCadastro() {
        btnListarCadastro.click();
        return this;
    }

    public MeuSite clicarListaQuestionario() {
        btnVoltar.click();
        btnListarQuestionario.click();
        return this;
    }


    public String fazAcoisa() {
        return driver.getPageSource();
    }
}


